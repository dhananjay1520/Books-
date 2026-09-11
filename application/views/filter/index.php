<section class="page-heading">
  <div>
    <span class="eyebrow">BOOKSTORE</span>
    <h1>Find your next book</h1>
    <p>Filter the collection by genre and price.</p>
  </div>
</section>

<div class="filter-layout">
  <aside class="card filter-card">
    <div class="filter-title"><i class="fa-solid fa-sliders"></i><h2>Filters</h2></div>
    <form method="get" action="<?= base_url('category') ?>">
      <label for="category">Category</label>
      <select name="category_slug" id="category">
        <option value="">All categories</option>
        <?php foreach ($categories as $cat): ?>
          <option value="<?= html_escape($cat) ?>" <?= $category_slug === $cat ? 'selected' : '' ?>>
            <?= html_escape($cat) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label>Price range</label>
      <div class="price-grid">
        <input type="number" min="0" name="min_price" placeholder="Min ₹" value="<?= html_escape($min_price ?? '') ?>">
        <input type="number" min="0" name="max_price" placeholder="Max ₹" value="<?= html_escape($max_price ?? '') ?>">
      </div>

      <button class="primary-btn full" type="submit"><i class="fa-solid fa-filter"></i> Apply Filters</button>
      <a class="clear-btn full" href="<?= base_url('category') ?>">Clear all</a>
    </form>
  </aside>

  <section class="results">
    <div class="results-head">
      <div><span class="eyebrow">COLLECTION</span><h2><?= count($books) ?> Books</h2></div>
    </div>

    <?php if (empty($books)): ?>
      <div class="empty-state small"><div class="empty-icon"><i class="fa-solid fa-book-open"></i></div><h2>No books found</h2><p>Try a different category or price range.</p></div>
    <?php else: ?>
      <div class="book-grid">
      <?php foreach ($books as $book): ?>
        <article class="book-card">
          <div class="book-cover"><img src="<?= book_image_url($book['image']) ?>" alt="<?= html_escape($book['pr_name']) ?>"></div>
          <div class="book-card-body">
            <h3><?= html_escape($book['pr_name']) ?></h3>
            <div class="book-price">₹<?= number_format((float)$book['pr_price'], 2) ?></div>
            <a class="secondary-btn" href="<?= base_url('book/'.$book['id']) ?>">View Details <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
      <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </section>
</div>
