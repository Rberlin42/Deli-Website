<?php 
  require_once('menu_functions.php');
  define('SAVE_METHOD', 'resources/menu-editor/save_menu');
?>
<div class="container-fluid pr-5 pl-0">
  <div class="row" id='editor'>
    <section class="col-lg-3 col-md-4 col-5 pt-5 pr-0 border-right" id="menu-sections">
      <h2 class='section-title pl-1'>Sections</h2>
      <div class="list-group list-group-flush border-top" id='sections-list'>
        <?php fetchSections(MENU_TYPE); ?>
      </div>
      <button class="add list-group-item list-group-item-action text-center bg-light rounded-0 border" id="add-section" onclick="addSection()">Add Section</button>
    </section>

    <section class="col-7 mt-5 mx-auto" id="menu-items">
      <h2 class='section-title pl-1'>Items</h2>
      <?php generateCMSMenuItems(MENU_TYPE); ?>
      <button class='add list-group-item list-group-item-action text-center bg-light' id='add-item' onclick='addItem()'>Add Item</button>
    </section>
  </div>

  <?php include('resources/savebar.php') ?>
</div> 