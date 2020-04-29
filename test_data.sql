INSERT INTO menu_sections VALUES
(1, 'Wraps', 'regular', 0),
(2, 'Burgers & Dogs', 'regular', 1),
(3, 'Toasted Specialty Paninis', 'regular', 2),
(4, 'House Specialty Heroes', 'catering', 0),
(5, 'Soup', 'special', 0),
(6, 'Specialy Sandwiches', 'regular', 3),
(7, 'Egg Omelettes and Platters', 'regular', 4),
(8, '3 to 6 Foot Party Heroes', 'catering', 1),
(9, 'Hot Entrees - Half or Full Trays', 'catering', 2),
(10, 'Quesadilla', 'special', 1);

INSERT INTO menu_items (name, description, sectionID, price, position) VALUES
('California Wrap', 'Grilled portobello mushrooms, roasted peppers, fresh mozzarella & pesto spread', 1, '$6.95', 0),
('Spa Wrap', 'Grilled eggplant, zucchini, squash, roasted peppers, carrots drizzled with aged balsamic vinegar', 1, '$6.95', 1),
('Carly Wrap', 'Fried eggplant, roasted peppers, fresh mozzarella, basil pesto dressing', 1, '$6.95', 2),
('Rachel Wrap', 'Chicked cutlet, fresh mozzarella cheese, roasted peppers, fresh basil', 1, '$6.95', 3),
('Turkey Wrap', 'Cracked pepper turkey with fresh cranberry sauce, romaine lettuce and bacon', 1, '$6.95', 5),
('Caesar Wrap', 'Grilled chicken, romaine lettuce, diced tomatoes, parmesan cheese and caesar dressing', 1, '$6.95', 6),
('Greek Wrap', 'Marinated chicken, red onion, feta cheese and romaine lettuce', 1, '$6.95', 7),
('Chicken Wrap', 'BBQ chicken, melted aged cheddar cheese, hot cherry peppers and romaine lettuce', 1, '$6.95', 8),
('Grilled Chicken Wrap', 'Swiss cheese, romaine lettuce with pesto spread', 1, '$6.95', 9),
('Benjamin Wrap', 'Roast beef, crisp bacon, aged cheddar cheese and BBQ sauce', 1, '$6.95', 10),
('Jonathon Wrap', 'Smoked turkey, provolone cheese, black forest ham, romaine lettuce and russian dressing', 1, '$6.95', 11),
('Brianna Wrap', 'Oven roasted turkey, melted american cheese, avocado, crisp lettuce and honey mustard spread on a whole wheat wrap', 1, '$6.95', 12),
('Sante fe wrap', 'Grilled chicken, cheddar cheese, avocado, black olives, tomato, lettuce and cilantro ranch dressing', 1, '$6.95', 13),
('Kenny Wrap', 'Grilled chicken, lettuce, craisans, walnuts, crumbled blue cheese, drizzled with raspberry vinagrette', 1, '$6.95', 14),
('Italian Wrap', 'Genoa salami, pepperoni, cappicola, provolone, lettuce, tomato, roasted peppers with oil and vinegar', 1, '$6.95', 15),
('Hamburger', '1/2lb. burger with lettuce, tomato & french fries', 2, '$7.49', 0),
('Cheeseburger', '1/2lb. cheeseburger & french fries', 2, '$7.99', 1),
('Blue Cheese Burger', '1/2lb. crumbled blue cheese burger & french fries', 2, '$7.99', 2),
('Bacon Burger', '1/2lb. bacon, cheddar burger & french fries', 2, '$8.49', 3),
('Cajun Burger', '1/2lb. cajun burger with onions, chili & french fries', 2, '$8.49', 4),
('Turkey Burger', 'Turkey burger with lettuce, tomato & french fries', 2, '$7.49', 5),
('Veggie Burger', 'Veggie burger with lettuce, tomato & french fries', 2, '$7.49', 6),
('Hot Dogs', '2 hot dogs with sauerkraut & french fries', 2, '$6.49', 7),
('Roast Beef Melt Panini', 'Roast beef, muenster cheese, sauteed onions, and russian dressing', 3, '$7.25', 0),
('Grilled Chicken Panini', 'Grilled chicken, roasted red peppers, fresh mozzarella and balsamic dressing', 3, '$7.25', 1),
('Honey Maple Panini', 'Honey maple turkey, apline lace swiss and cole slaw', 3, '$7.25', 2),
('BBQ Roast Beef Panini', 'Roast beef, bacon, cheddar, and barbecue sauce', 3, '$7.25', 3),
('Chicken Cutlet Panini', 'Chicken cutlet, bacon, melted american cheese and russian dressing', 3, '$7.25', 4),
('Buffalo Chicken Panini', 'Buffalo chicken breast and melted cheddar with blue cheese dressing and buffalo sauce', 3, '$7.25', 5),
('Buffalo Ranch Panini', 'Buffalo chicken breast with muenster cheese and ranch dressing', 3, '$7.25', 6),
('Godfather Panini', 'Cappicola, salami, pepperoni and provolone', 3, '$7.25', 7),
('Pepper Turkey Panini', 'Pepper turkey with bacon, melted alpine swiss and honey mustard', 3, '$7.25', 8),
('Pastrami Panini', 'Pastrami, swiss cheese, cole slaw, and russian dressing', 3, '$7.25', 9),
('Monte Cristo Panini', 'Turkey, ham, and melted swiss cheese with russian dressing', 3, '$7.25', 10),
('Eggplant Panini', 'Fried eggplant, provolone cheese, sun dried tomatoes, and italian dressing', 3, '$7.25', 11),
('The Ever Roast Panini', 'Ever roast chicken breast, bacon, cheddar, and russian dressing', 3, '$7.25', 12),
('Peppered Panini', 'Cracked pepper turkey, jalapeno peppers, pepper jack cheese, and our honey mustard', 3, '$7.25', 13),
('Blackend Chicken Panini', 'Blackend chicken, fresh mozzarella and roasted peppers', 3, '$7.25', 14),
('Grilled Chicken Tomato Panini', 'Grilled chicken, alpine lace swiss, sun dried tomato and honey mustard', 3, '$7.25', 15),
('Virginia Ham Panini', 'Virginia ham, bacon, american cheese, and ranch dressing', 3, '$7.25', 16),
('Smoked BBQ Chicken Panini', 'Chicken cutlet, bacon, melted smoked gouda and BBQ sauce', 3, '$7.25', 17),
('Garden', 'Marinated fresh portebello mushrooms grilled with assorted fresh grilled vegetables, red onions, & fresh mozzarella', 4, '$18.50 per foot', 0),
('The Touchdown', 'Breaded chicken cutlet, bacon, fresh mozzarella, cheddar cheese, lettuce, and tomatoes', 4, '$18.95 per foot', 1),
('Chicken', 'Marinated herb grilled chicken, marinated fresh portobello mushrooms, fresh mozzarella, roasted red peppers, and fresh basil', 4, '$18.95 per foot', 2),
('Super Chicken', 'Breaded chicken cutlet, fresh mozzarella, roasted red peppers and tomatoes', 4, '$18.95 per foot', 3),
('New England Clam Chowder', '', 5, '$2.99', 0),
('Broccoli Cheddar', '', 5, '$2.99', 1),
('Chicken Quesadilla', 'Chicken, peppers, onions, salsa, black olives and fresh cilantro', 10, '$6.99', 0),
('Smoked Turkey', 'Smoked turkey, brie cheese, honey mustard on a cracked wheat roll', 6, '$8.50', 0),
('Turkey', 'Turkey, roasted peppers, fresh mozzarella on oven baked bread', 6, '$8.50', 1),
('Grilled Chicken', 'Grilled chicken with montery jack cheese, leaf lettuce and tomato on a pesto roll', 6, '$8.50', 2),
('BBQ Chicken Breast', 'BBQ chicken breast with hot cherry peppers and aged cheddar on country bread', 6, '$8.50', 3),
('Reuben', 'Hot corned beef and sauerkraut with swiss cheese on grilled rye bread', 6, '$8.50', 4),
('Monte Cristo', 'Black forest ham, swiss cheese and smoked turkey', 6, '$8.50', 5),
('Roast Beef', 'Roast beef with crumbled blue cheese and roasted peppers on chiabatta bread', 6, '$8.50', 6),
('3 Eggs, cheese, and home fries', '', 7, '$3.95', 0),
('3 Eggs, broccoli, tomato with home fries', '', 7, '$4.20', 1),
('3 Eggs, bacon, ham or sausage & cheese with home fries', '', 7, '$4.20', 2),
('3 Egg Whites, mushroom and swiss with home fries', '', 7, '$4.20', 3),
('3 Eggs, turkey, tomatoes and cheddar with home fries', '', 7, '$4.20', 4),
('French Toast', '3 pieces with maple syrup and home fries', 7, '$4.20', 5),
('Pancakes', '3 buttermilk pancakes with warm syrup and home fries', 7, '$4.20', 6),
('American Style', 'Roast beef, ham, turkey, bologna, swiss and american cheese, lettuce and tomatoes', 8, '$15.50 per foot', 0),
('Italian Style', 'Genoa salami, cappicola, pepperoni, provolone cheese, roasted red peppers, leaf lettuce and italian dressing on the side', 8, '$15.59 per foot', 1),
('Baked Ziti', '', 9, '', 0),
('Penne Alla Vodka', '', 9, '', 1),
('Chicken Parmesan', '', 9, '', 2),
('Sausage and Peppers', '', 9, '', 3),
('Homemade Chili', '', 9, '', 4),
('Chicken Fingers', '', 9, '', 5),
('Eggplant Parmesan', '', 9, '', 6);

INSERT INTO announcements (title, description, position) VALUES 
('Holiday Special!', '20% off all wraps through the holiday season', 0),
('Superbowl Squares Pool', 'Stop by the deli to buy into our annual Superbowl Squares Pool for a chance to win $1000!', 1),
('Holiday Hours Update', 'We will not be open on Christmas', 2);

INSERT INTO contact_us (name, email, subject, message) VALUES
('Logan Ramos', 'ramosl@rpi.edu', 'When do you open?', 'I was wondering what time you open on christmas?'),
('Ryan Berlin', 'berlin@wall.com', 'Dietary Restrictions', 'I was wondering if all your food was kosher? Please let me know!'),
('Barry B. Benson', 'bee@movie.com', 'Bee Movie', "According to all known laws 
of aviation,
there is no way a bee
should be able to fly.
Its wings are too small to get
its fat little body off the ground.
The bee, of course, flies anyway
because bees don't care
what humans think is impossible.
");

INSERT INTO cms_data (sectionName, sectionText) VALUES
('about', 'Owner born and raised in Plainview, serving the community the finest and freshest ingredients for over 30 years. The homemade potato macaroni and cole slaw are well known throughout the community.'),
('catering', 'Stop in the deli and see Brian for all of your catering needs.  Call (516) 681-1670 and ask for Brian for more info.'),
('hours', 'Monday-Friday: 7am - 7pm\nSaturday: 7am - 4pm\nSunday: 8am - 3pm');