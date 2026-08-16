-- Seed Data for Hotel Nataraj

USE `hotel_nataraj`;

-- Clear existing data
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `menu_items`;
TRUNCATE TABLE `categories`;
SET FOREIGN_KEY_CHECKS = 1;

-- Categories
INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `display_order`) VALUES
(1, 'Starters & Tandoor', 'starters-tandoor', 'Authentic clay-oven tandoori appetizers and sizzling delights', 1),
(2, 'Main Course', 'main-course', 'Rich aromatic curries, gravies, and royal North Indian specialties', 2),
(3, 'Biryani & Rice', 'biryani-rice', 'Saffron-infused handi biryanis and fragrant basmati preparations', 3),
(4, 'Tandoori Breads', 'breads', 'Freshly baked naan, kulchas, and parathas straight from the tandoor', 4),
(5, 'Desserts', 'desserts', 'Royal Indian sweets and handcrafted icy treats', 5),
(6, 'Mocktails & Drinks', 'beverages', 'Refreshing artisanal cooler blends, lassis, and hot beverages', 6);

-- Menu Items
INSERT INTO `menu_items` (`category_id`, `name`, `description`, `price`, `is_veg`, `spice_level`, `image_url`, `is_featured`, `is_available`) VALUES
-- Starters
(1, 'Royal Tandoori Paneer Tikka', 'Fresh cottage cheese cubes marinated in yellow mustard, yogurt, and aromatic tandoori spices, char-grilled to perfection.', 340.00, 1, 'Medium', 'assets/images/paneer_tikka.jpg', 1, 1),
(1, 'Hara Bhara Kabab', 'Pan-seared spinach, green pea, and cashew patties infused with roasted cumin and royal garam masala.', 290.00, 1, 'Mild', 'assets/images/paneer_tikka.jpg', 0, 1),
(1, 'Malai Soya Chaap', 'Tender soya chunks marinated in creamy cashew paste, cardamom, and fresh malai, slow roasted.', 320.00, 1, 'Mild', 'assets/images/paneer_tikka.jpg', 1, 1),
(1, 'Tandoori Mushroom Stuffed', 'Button mushrooms stuffed with spiced cheese and spinach, glaze grilled in tandoor.', 330.00, 1, 'Spicy', 'assets/images/paneer_tikka.jpg', 0, 1),

-- Main Course
(2, 'Special Dal Makhani', 'Overnight slow-cooked black lentils enriched with churned butter, fresh cream, and smoked tomatoes.', 310.00, 1, 'Mild', 'assets/images/dal_makhani.jpg', 1, 1),
(2, 'Paneer Butter Masala', 'Char-broiled cottage cheese simmered in a velvety tomato, cashew nut, and butter gravy with kasuri methi.', 360.00, 1, 'Medium', 'assets/images/dal_makhani.jpg', 1, 1),
(2, 'Kadhai Paneer Special', 'Paneer cubes tossed with crisp bell peppers, whole coriander seeds, and crushed Kashmiri chilies.', 350.00, 1, 'Spicy', 'assets/images/dal_makhani.jpg', 0, 1),
(2, 'Malai Kofta Dum Pukht', 'Melt-in-mouth paneer-khoya dumplings stuffed with dry fruits, served in a rich shahi white cashew gravy.', 380.00, 1, 'Mild', 'assets/images/dal_makhani.jpg', 1, 1),
(2, 'Subz Handi Deewani', 'Assorted garden fresh vegetables simmered in a fragrant green coriander and spinach gravy.', 320.00, 1, 'Medium', 'assets/images/dal_makhani.jpg', 0, 1),

-- Biryani & Rice
(3, 'Hotel Nataraj Special Shahi Biryani', 'Long grain basmati rice cooked dum style with marinated cottage cheese, saffron, mint, fried onions, and dry fruits.', 390.00, 1, 'Medium', 'assets/images/biryani.jpg', 1, 1),
(3, 'Hyderabadi Veg Dum Biryani', 'Spiced seasonal vegetables layered with saffron rice and fragrant kewra water, served with burani raita.', 340.00, 1, 'Spicy', 'assets/images/biryani.jpg', 0, 1),
(3, 'Jeera Basmati Rice', 'Steamed royal basmati rice tempered with aromatic cumin seeds and desi ghee.', 210.00, 1, 'Mild', 'assets/images/biryani.jpg', 0, 1),

-- Breads
(4, 'Butter Garlic Naan', 'Refined flour bread baked in tandoor, slathered with garlic butter and fresh cilantro.', 75.00, 1, 'Mild', 'assets/images/dal_makhani.jpg', 1, 1),
(4, 'Stuffed Amritsari Kulcha', 'Crispy layered tandoori bread stuffed with spiced mashed potatoes and cottage cheese.', 95.00, 1, 'Medium', 'assets/images/dal_makhani.jpg', 0, 1),
(4, 'Cheese Garlic Naan', 'Soft clay oven bread stuffed with gooey mozzarella and topped with crushed garlic.', 110.00, 1, 'Mild', 'assets/images/dal_makhani.jpg', 1, 1),
(4, 'Tandoori Roti Desi Ghee', 'Traditional whole wheat bread baked in clay oven brushed with pure cow ghee.', 45.00, 1, 'Mild', 'assets/images/dal_makhani.jpg', 0, 1),

-- Desserts
(5, 'Saffron Gulab Jamun (2 Pcs)', 'Warm milk dumplings soaked in saffron and cardamom scented sugar syrup, topped with silver leaf.', 150.00, 1, 'Mild', 'assets/images/gulab_jamun.jpg', 1, 1),
(5, 'Special Kesar Rasmalai', 'Soft paneer disks soaked in thickened saffron rabri garnished with sliced pistachios and almonds.', 180.00, 1, 'Mild', 'assets/images/gulab_jamun.jpg', 1, 1),
(5, 'Matka Kulfi Falooda', 'Traditional slow-reduced milk kulfi served with rose syrup, falooda noodles, and basil seeds.', 160.00, 1, 'Mild', 'assets/images/gulab_jamun.jpg', 0, 1),

-- Beverages
(6, 'Royal Rose Blossom Mocktail', 'Fragrant rose syrup infused with chilled sparkling soda, lime juice, and basil seeds.', 180.00, 1, 'Mild', 'assets/images/drinks.jpg', 1, 1),
(6, 'Traditional Mango Panna', 'Tangy raw mango cooler spiced with roasted cumin, black salt, and fresh mint leaves.', 150.00, 1, 'Medium', 'assets/images/drinks.jpg', 1, 1),
(6, 'Kesar Dry Fruit Lassi', 'Thick whipped sweet yogurt topped with saffron strands, crushed almonds, and pistachios.', 160.00, 1, 'Mild', 'assets/images/drinks.jpg', 0, 1);
