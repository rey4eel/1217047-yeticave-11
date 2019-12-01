<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">

        <!--Foreach function added-->
        <?php foreach ($categories as $category): ?>

            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html"><?=$category['title']; ?></a>
            </li>

        <?php endforeach; ?>

    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">

        <!--заполните этот список из массива с товарами-->
        <?php foreach($lots as $lot) : ?>
            <?php
                list($hour,$min)= get_exp_time($lot['end_date']);
            ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=$lot['image'];?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=$lot['title'];?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?=$lot['title'];?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=price_format($lot['initial_price']);?></span>
                        </div>
                        <div class="lot__timer timer <?= $hour === 0 ? 'timer--finishing' : '' ?>" >
                            <?=sprintf('%02d',$hour).':'.sprintf('%02d',$min);?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>

    </ul>
</section>
