<h1>Welcome to My Blog</h1>
<h2>All Posts</h2>

<form action="" method="GET">
  <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search posts..." />
  <button>Search</button>
</form>
<?= partial('_posts', ['posts' => $posts]) ?>