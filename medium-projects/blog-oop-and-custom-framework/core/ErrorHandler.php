<?php

namespace Core;

class ErrorHandler {
    public static function handleException(\Throwable $exception){
        //1. log the error
        //php bin/load_schema.php
        // Check if the script is running in the CLI context
        if(php_sapi_name() === 'cli'){
            // Render error specifically for the CLI environment
            static::renderCliError($exception);
        } else {
            //static::renderErrorPage($exception);
        }
    }

    // Method to format and display errors in the CLI
    private static function renderCliError(\Throwable $exception): void {
        // Get the debug flag from configuration
        $isDebug = App::get('config')['app']['debug'] ?? false;

        // If debug mode is enabled, show detailed error message and stack trace
        if($isDebug){
            $errorMessage = static::formatErrorMessage(
                $exception,
                "\033[31m[%s] Error: \033[0m %s: %s in %s on line %d\n"
            );
            $trace = $exception->getTraceAsString();
        // In non-debug mode, show a more generic error message
        } else {
            $errorMessage = "\033[31m[%s] An unexpected error occurred \033[0m \n";
            $trace = "";
        }

        fwrite(STDERR, $errorMessage);
        if($trace){
            fwrite(STDERR, "\nStack trace:\n$trace\n");
        }
        exit(1);
    }

    // Handle PHP errors by converting them into exceptions
    public static function handleERror($level, $message, $file, $line){
        // Convert the error into an exception and pass it to the exception handler
        $exception = new \ErrorException($message, 0, $level, $file, $line);
        static::handleException($exception);
    }
    
    // Helper method to format the error message in a standard format
    private static function formatErrorMessage(\Throwable $exception, string $format): string{
        return sprintf(
            $format,
            date('Y-m-d H:i:s'),
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine()
        );
    }
}