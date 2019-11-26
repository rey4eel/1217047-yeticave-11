/*Заполнение таблицы Категории */
INSERT INTO categories
        (title,code)
VALUES
        ('Доски и лыжи','equipments'),
        ('Крепления','fixators'),
        ('Ботинки','footwears'),
        ('Одежда','clothes'),
        ('Инструменты','tools'),
        ('Разное','others');


/*Заполнение таблицы Пользователи*/

INSERT INTO users
        (name,email,user_password,contacts)
VALUES
        ('John','john2019@gmail.com','123','89095157163'),
        ('Adam','adam2019@gmail.com','456','89095197163'),
        ('Kent','kent2019@gmail.com','789','89095207163'),
        ('Bill','bill2019@gmail.com','101','89095217163'),
        ('Sara','sara2019@gmail.com','102','89095227163'),
        ('Volodya','volodya2019@gmail.com','103','89095237163');

/*Заполнение таблицы Лот*/
INSERT INTO lot
        (title,description,image,initial_price,end_date,step,author_id,category_id)
VALUES
    ('2014 Rossignol District Snowboard', 'description 1', 'img/lot-1.jpg', 10999, '2019-11-05', '2019-11-10', 1000, 1, 1),
    ('DC Ply Mens 2016/2017 Snowboard', 'description 2', 'img/lot-2.jpg', 159999, '2019-12-07', '2019-12-12', 5000, 1, 1),
    ('Крепления Union Contact Pro 2015 года размер L/XL', 'description 3', 'img/lot-3.jpg', 8000, '2019-11-06', '2019-11-05', 500, 1, 2),
    ('Ботинки для сноуборда DC Mutiny Charocal', 'description 4', 'img/lot-4.jpg', 10999, '2019-11-09', '2019-11-12', 1000, 2, 3),
    ('Куртка для сноуборда DC Mutiny Charocal', 'description 5', 'img/lot-5.jpg', 7500, '2020-11-06', '2020-11-13', 100, 2, 4),
    ('Маска Oakley Canopy', 'description 6', 'img/lot-6.jpg', 10999, '2019-11-05', '2019-11-14', 200, 2, 6);


/*Заполнение таблицы Ставки*/

INSERT INTO bet
        (amount,user_id, lot_id)
VALUES
    (15000, 1, 1),
    (6000, 1, 1),
    (228000, 2, 2),
    (314000, 1, 2),
    (6300, 1, 3),
    (23000, 2, 3);

/*обновить название лота по его идентификатору */

UPDATE lot SET title = 'District Snowboard' WHERE id='1';


/*получить все категории */

SELECT * FROM categories;


/*получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, текущую цену, название категории */

SELECT l.initial_price, l.image, l.step, c.title, bet.amount
FROM lot l
JOIN categories c ON l.category_id = c.id
JOIN bet ON bet.lot_id = l.id
WHERE date_end > NOW()
ORDER BY creation_time DESC;


/*показать лот по его id , Получите также название категории, к которой принадлежит лот*/

SELECT * FROM lot
JOIN categories
ON lot.category_id = categories.id
WHERE lot.id = 1;


/*получить список ставок для лота по его идентификатору с сортировкой по дате */

SELECT lot_id FROM bet ORDER BY creation_time DESC ;


