-- BookSpot Wishlist table (optional persistent wishlist schema)
-- Current BookSpot frontend uses session-based wishlist IDs, so this table is not required.
-- Keep this script for future DB-backed wishlist migration.

CREATE TABLE IF NOT EXISTS wishlist (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_wishlist_user_product (user_id, product_id),
    KEY idx_wishlist_user (user_id),
    KEY idx_wishlist_product (product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
