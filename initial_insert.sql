use bookify;

-- ============================================
-- Seed data for bookify database
-- Insert order respects foreign key dependencies:
-- country -> city -> location -> hotel -> hotel_image
-- -> room -> room_image -> users -> reservation
-- ============================================

-- ----------------------
-- country
-- ----------------------
INSERT INTO country (name) VALUES
('Serbia'),
('Croatia'),
('Greece');

-- ----------------------
-- city
-- ----------------------
INSERT INTO city (name, country_id) VALUES
('Belgrade', 1),
('Novi Sad', 1),
('Dubrovnik', 2),
('Athens', 3);

-- ----------------------
-- location
-- ----------------------
INSERT INTO location (city_id, address) VALUES
(1, 'Knez Mihailova 12'),
(1, 'Bulevar Kralja Aleksandra 73'),
(2, 'Zmaj Jovina 5'),
(3, 'Stradun 1'),
(4, 'Syntagma Square 3');

-- ----------------------
-- hotel
-- ----------------------
INSERT INTO hotel (name, location_id, description, type, email, phone) VALUES
('Hotel Moskva', 1, 'A historic luxury hotel in the heart of Belgrade, known for its iconic facade and central location.', 'Luxury', 'info@hotelmoskva.rs', '+381111234567'),
('Park Inn Belgrade', 2, 'A modern business-friendly hotel with easy access to conference venues and the city center.', 'Business', 'reservations@parkinnbelgrade.rs', '+381112345678'),
('Hotel Veliki', 3, 'A boutique hotel offering riverside views and a cozy atmosphere in Novi Sad.', 'Boutique', 'contact@hotelveliki.rs', '+381212233445'),
('Hilton Imperial Dubrovnik', 4, 'A 5-star hotel just outside the Old Town walls with panoramic Adriatic views.', 'Resort', 'info@hiltonimperial.hr', '+38520320320'),
('Athens Center Hotel', 5, 'A comfortable, affordable hotel steps away from Syntagma Square and major attractions.', 'Budget', 'info@athenscenterhotel.gr', '+302103456789');

-- ----------------------
-- hotel_image
-- ----------------------
INSERT INTO hotel_image (image, path, hotel_id) VALUES
('moskva_exterior.jpg', 'uploads/hotels/1/moskva_exterior.jpg', 1),
('moskva_lobby.jpg',    'uploads/hotels/1/moskva_lobby.jpg', 1),
('parkinn_exterior.jpg','uploads/hotels/2/parkinn_exterior.jpg', 2),
('veliki_room.jpg',     'uploads/hotels/3/veliki_room.jpg', 3),
('hilton_pool.jpg',     'uploads/hotels/4/hilton_pool.jpg', 4),
('hilton_view.jpg',     'uploads/hotels/4/hilton_view.jpg', 4),
('athenscenter_front.jpg','uploads/hotels/5/athenscenter_front.jpg', 5);

-- ----------------------
-- room
-- ----------------------
INSERT INTO room (beds, balcony, pricePerNight, type, description, hotel_id) VALUES
(2, 1, 89.99,  'Double Room', 'Comfortable double room with city view and modern amenities.', 1),
(1, 0, 59.99,  'Single Room', 'Cozy single room ideal for solo travelers.', 1),
(2, 1, 75.00,  'Standard Double', 'Spacious double room close to the conference hall.', 2),
(3, 0, 110.00, 'Family Room', 'Family room with three beds, suitable for up to 5 guests.', 3),
(2, 1, 220.00, 'Deluxe Sea View', 'Deluxe room with a private balcony overlooking the Adriatic Sea.', 4),
(2, 1, 180.00, 'Superior Room', 'Elegant room with modern furnishings and balcony access.', 4),
(1, 0, 45.00,  'Economy Single', 'Compact and affordable single room near Syntagma Square.', 5);

-- ----------------------
-- room_image
-- ----------------------
INSERT INTO room_image (image, path, room_id) VALUES
('double_room1.jpg',  'uploads/rooms/1/double_room1.jpg', 1),
('single_room1.jpg',  'uploads/rooms/2/single_room1.jpg', 2),
('standard_double1.jpg','uploads/rooms/3/standard_double1.jpg', 3),
('family_room1.jpg',  'uploads/rooms/4/family_room1.jpg', 4),
('deluxe_seaview1.jpg','uploads/rooms/5/deluxe_seaview1.jpg', 5),
('deluxe_seaview2.jpg','uploads/rooms/5/deluxe_seaview2.jpg', 5),
('superior_room1.jpg','uploads/rooms/6/superior_room1.jpg', 6),
('economy_single1.jpg','uploads/rooms/7/economy_single1.jpg', 7);

-- ----------------------
-- users
-- Note: passwords below are PLACEHOLDER bcrypt-style hashes.
-- In your real app, always generate these with PHP's password_hash($password, PASSWORD_DEFAULT)
-- ----------------------
INSERT INTO users (username, first_name, last_name, email, password, role) VALUES
('admin',     'Site',   'Administrator', 'admin@bookify.com',   '$2y$10$abcdefghijklmnopqrstuv1234567890ABCDEFGHIJKLMNOPQRSTU', 'admin'),
('jmanager',  'Jovan',  'Petrovic',      'jovan.petrovic@bookify.com', '$2y$10$abcdefghijklmnopqrstuv1234567890ABCDEFGHIJKLMNOPQRSTU', 'manager'),
('mstefanovic','Milica','Stefanovic',    'milica.s@example.com', '$2y$10$abcdefghijklmnopqrstuv1234567890ABCDEFGHIJKLMNOPQRSTU', 'user'),
('lpapadopoulos','Lukas','Papadopoulos', 'lukas.p@example.com',  '$2y$10$abcdefghijklmnopqrstuv1234567890ABCDEFGHIJKLMNOPQRSTU', 'user'),
('amaric',    'Ana',    'Maric',         'ana.maric@example.com','$2y$10$abcdefghijklmnopqrstuv1234567890ABCDEFGHIJKLMNOPQRSTU', 'user');

-- ----------------------
-- reservation
-- ----------------------
INSERT INTO reservation (user_id, room_id, check_in, check_out, total_price) VALUES
(3, 1, '2026-07-10', '2026-07-14', 359.96),   -- 4 nights * 89.99
(3, 5, '2026-08-01', '2026-08-05', 880.00),   -- 4 nights * 220.00
(4, 7, '2026-06-25', '2026-06-28', 135.00),   -- 3 nights * 45.00
(5, 4, '2026-09-12', '2026-09-15', 330.00),   -- 3 nights * 110.00
(5, 3, '2026-07-20', '2026-07-22', 150.00);   -- 2 nights * 75.00