jQuery(function ($) {

    $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#close-sidebar").click(function() {
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
  $(".page-wrapper").addClass("toggled");
});


   
   
});


function appear() {
  var editForm = document.getElementById('edit');
  editForm.style.display = 'inline-block';
}

function hide(){
  var editForm = document.getElementById('edit');
  editForm.style.display = 'none';
}

function toggleTooltip() {
  const tooltip = document.getElementById('emailTooltip');
  const isVisible = tooltip.getAttribute('aria-hidden') === 'false';
  tooltip.setAttribute('aria-hidden', !isVisible);
}

function theme(){
  var slide = document.getElementById('sidebar');
  slide.style.backgroundColor = '#282c33';
}
