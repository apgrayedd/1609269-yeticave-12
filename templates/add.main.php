<main>
    <form class="form form--add-lot container <?=($status['form']) ? "":"form--invalid"?>" action="/add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
      <h2>Добавление лота</h2>
      <div class="form__container-two">
        <div class="form__item <?=($status['name']) ? "" : "form__item--invalid"?>"> <!-- form__item--invalid -->
          <label for="lot-name">Наименование <sup>*</sup></label>
          <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value=<?=getPostVal("lot-name")?>>
          <span class="form__error" ><?=($status['name']) ? "" : $errors['name']?></span>
        </div>
        <div class="form__item">
          <label for="category">Категория <sup>*</sup></label>
          <select id="category" name="category">

          <?php foreach($categorys as $category):?>
            <option><?=$category['category']?></option>
          <?php endforeach;?>

          </select>
          <span class="form__error">Выберите категорию</span>
        </div>
      </div>
      <div class="form__item form__item--wide <?=($status['message']) ? "" : "form__item--invalid" ?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите описание лота"></textarea>
        <span class="form__error"><?=($status['message']) ? "" : $errors['message']?></span> 
      </div>
      <div class="form__item form__item--file <?=($status['file']) ? "" : "form__item--invalid" ?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
          <input name= 'lot-img'class="visually-hidden" type="file" id="lot-img" value="">
          <label for="lot-img">
            Добавить
          </label>
        </div>
      </div>
      <div class="form__container-three">
        <div class="form__item form__item--small <?=($status['rate']) ? "" : "form__item--invalid" ?>">
          <label for="lot-rate">Начальная цена <sup>*</sup></label>
          <input id="lot-rate" type="text" name="lot-rate" placeholder="0"  value=<?=getPostVal("lot-rate")?>>
          <span class="form__error"><?=($status['rate']) ? "" : $errors['lot-rate']?></span>
        </div>
        <div class="form__item form__item--small <?=($status['step']) ? "" : "form__item--invalid" ?>">
          <label for="lot-step">Шаг ставки <sup>*</sup></label>
          <input id="lot-step" type="text" name="lot-step" placeholder="0" value=<?=getPostVal("lot-step")?>>
          <span class="form__error">Введите шаг ставки</span>
        </div>
        <div class="form__item <?=($status['date']) ? "" : "form__item--invalid" ?>">
          <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
          <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value=<?=getPostVal("lot-date")?>>
          <span class="form__error">Введите дату завершения торгов</span>
        </div>
      </div>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" class="button">Добавить лот</button>
    </form>
</main>