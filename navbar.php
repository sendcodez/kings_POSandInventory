<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
    <!--<title>Dashboard Sidebar Menu</title>--> 
</head>

<style>
.beige-background {
        background-color: #f5f5dc; /* Beige background color */
    }

    .white-text {
        color: #0A0A0A; /* White text color */
    }

    .border-beige {
        border: 1px solid #FCFCD4; /* Beige border color */
    }

 /*========== GOOGLE FONTS ==========*/
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

/*========== VARIABLES CSS ==========*/
:root {
  --header-height: 3.5rem;
  --nav-width: 219px;

  /*========== Colors ==========*/
  --first-color: #000000;
  --first-color-light: #FAF8F0;
  --title-color: #19181B;
  --text-color: #58555E;
  --text-color-light: #A5A1AA;
  --body-color: #FFFFFF;
  --container-color: #FFFFFF;

  /*========== Font and typography ==========*/
  --body-font: 'Poppins', sans-serif;
  --normal-font-size: .938rem;
  --small-font-size: .75rem;
  --smaller-font-size: .75rem;

  /*========== Font weight ==========*/
  --font-medium: 500;
  --font-semi-bold: 600;

  /*========== z index ==========*/
  --z-fixed: 100;
}

@media screen and (min-width: 1024px) {
  :root {
    --normal-font-size: 1rem;
    --small-font-size: .875rem;
    --smaller-font-size: .813rem;
  }
}

/*========== BASE ==========*/
*, ::before, ::after {
  box-sizing: border-box;
}

body {
  margin: var(--header-height) 0 0 0;
  padding: 1rem 1rem 0;
  font-family: var(--body-font);
  font-size: var(--normal-font-size);
  background-color: var(--body-color,);
  color: var(--text-color);
}

h3 {
  margin: 0;
}

a {
  text-decoration: none;
}

img {
  max-width: 100%;
  height: auto;
}

/*========== HEADER ==========*/
.header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: var(--container-color);
  box-shadow: 0 1px 0 rgba(22, 8, 43, 0.1);
  padding: 0 1rem;
  z-index: var(--z-fixed);
}

.header__container {
  display: flex;
  align-items: center;
  height: var(--header-height);
  justify-content: space-between;
}

.header__img {
  width: 35px;
  height: 35px;
  border-radius: 50%;
}

.header__logo {
    color: var(--first-color-light);
    font-weight: var(--font-large);
    margin-left:45px;
    margin-top: 5px;
    display: none;
}


.header__icon, 
.header__toggle {
  font-size: 1.2rem;
}

.header__toggle {
  color: black;
  cursor: pointer;
}


/*========== NAV ==========*/
.nav {
  position: fixed;
  top: 0;
  left: -100%;
  height: 100vh;
  padding: 1rem 1rem 0;
  background-color: var(--container-color);
  box-shadow: 1px 0 0 rgba(22, 8, 43, 0.1);
  z-index: var(--z-fixed);
  transition: .4s;
  background: linear-gradient(to top, #000000, #F48F00);
}

.nav__container {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding-bottom: 3rem;
  overflow: auto;
  scrollbar-width: none; /* For mozilla */
 
  
}

/* For Google Chrome and others */
.nav__container::-webkit-scrollbar {
  display: none;
}

.nav__logo {
  font-weight: var(--font-semi-bold);
  margin-bottom: 2.5rem;
}

.nav__list, 
.nav__items {
  display: grid;
}

.nav__list {
  row-gap: 2.5rem;
}

.nav__items {
  row-gap: 1.5rem;
}


.nav__subtitle {
  font-size: var(--normal-font-size);
  text-transform: uppercase;
  letter-spacing: .1rem;
  color: var(--text-color-light);
}

.nav__link {
  display: flex;
  align-items: center;
  color: var(--first-color-light);
}


.nav__link:hover {
  color: var(--first-color-light);
  border-radius: 10px;
  padding: 10px 5px;
  transition: left 0.3s; /* Smooth transition for left position */

}

.nav__items a:hover{
    background-color: var(--first-color);
    transition: left 0.3s; /* Smooth transition for left position */
}


.nav__icon {
  font-size: 1.2rem;
  margin-right: .5rem;
}

.nav__icon1{
  width: 40px;
  height: 35px;
  border-radius: 50%;
  position:absolute;
  margin-left: -15px;
  margin-top: -7px;
}

.text nav-text {
  font-size: var(--small-font-size);
  font-weight: var(--font-medium);
  white-space: nowrap;
}

.nav__logout {
  margin-top: 5rem;
}

/* Dropdown */
.nav__dropdown {
  overflow: hidden;
  max-height: 21px;
  transition: .4s ease-in-out;
}

.nav__dropdown-collapse {
  background-color: var(--first-color-light);
  border-radius: .25rem;
  margin-top: 1rem;
  width: 200px;
}

.nav__dropdown-content {
  display: grid;
  row-gap: .5rem;
  padding: .75rem 2.5rem .75rem 1.8rem;
}

.nav__dropdown-item {
  font-size: 15px;
  font-weight: var(--font-medium);
  color: var(--text-color);
}

.nav__dropdown-item:hover {
  color: #fff;
}



.nav__dropdown-icon {
  margin-left: auto;
  transition: .4s;
}

/* Show dropdown collapse */
.nav__dropdown:hover {
  max-height: 100rem;
}

/* Rotate icon arrow */
.nav__dropdown:hover .nav__dropdown-icon {
  transform: rotate(180deg);
}

/*===== Show menu =====*/
.show-menu {
  left: 0;
}

/*===== Active link =====*/
.active {
  color: var(--first-color);
}


/* ========== MEDIA QUERIES ==========*/
/* For small devices reduce search*/

@media screen and (min-width: 768px) {
  body {
    padding: 1rem 3rem 0 6rem;
  }
  .header {
    padding: 0 3rem 0 6rem;
  }
  .header__container {
    height: calc(var(--header-height) + .5rem);
  }
  .header__search {
    width: 300px;
    padding: .55rem .75rem;
  }
  .header__search {
  display: flex;
  padding: .40rem .75rem;
  background-color: var(--first-color-light);
  border-radius: .25rem;
}

.header__input {
  width: 100%;
  border: none;
  outline: none;
  background-color: var(--first-color-light);
}

.header__input::placeholder {
  font-family: var(--body-font);
  color: var(--text-color);
}

  .header__toggle {
    display: none;
  }
  .header__logo {
    display: block;
  }
  .header__img {
    width: 40px;
    height: 40px;
    order: 1;
  }
  .nav {
    left: 0;
    padding: 1.2rem 1.5rem 0;
    width: 68px; /* Reduced navbar */
  }
  .nav__items {
    row-gap: 1.7rem;
  }
 
  .nav__icon {
    font-size: 1.3rem;
  }


  /* Element opacity */
  .nav__logo-name, 
  .text nav-text, 
  .nav__subtitle, 
  .nav__dropdown-icon {
    opacity: 0;
    transition: .3s;
  }
  
  
  /* Navbar expanded */
  .nav:hover {
    width: var(--nav-width);
  }
  
  /* Visible elements */
  .nav:hover .nav__logo-name {
    opacity: 1;
  }
  .nav:hover .nav__subtitle {
    opacity: 1;
  }
  .nav:hover .text nav-text {
    opacity: 1;
  }
  .nav:hover .nav__dropdown-icon {
    opacity: 1;
  }
}

.center-text {
        text-align: center;
    }

    .increase-font {
        font-size: 15px; /* You can adjust the font size as needed */
    }

    .nav-item{
    position:relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width:50px;
    height:50px;
    background: #311D01#D78C15;
    border: none;
    outline: none;
    border-radius: 50%;
  }

  .notification-badge{
    position: absolute;
    top:-3px;
    font-size: 13px;
    right: -1px;
    width: 21px;
    height: 21px;
    background: #502913EB;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
  } 
  
</style>
<body >
     <!--========== HEADER ==========-->
     <header class="header" style="background-color: #FFFFFF; height: px; width: 100%;">
            <div class="header__container">
               <!-- <img src="kings.jpg" alt="" class="header__img">-->
           
                        <h5 style = "color:#D78C15"><b>King's Coffee</b></h5>
                        <nav>
                <div class="nav-item" style="margin-right: -30px;">
                    <button class="btn my-2 my-sm-0 rounded-circle" type="button" id="notificationButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell' style="font-size:22px;"></i>
                            <span id="notificationBadge" class="notification-badge">0</span>
                    </button>
    
     <!-- Dropdown menu for expired products -->
    <div class="dropdown-menu " aria-labelledby="notificationButton" style="width: 370px; left: -520%;background-color: #FFFFEE;">
    <div id="expiredProductsContainer" style="display: none;">
    <h2 class="dropdown-header white-text center-text increase-font">EXPIRED PRODUCTS AND INGREDIENTS</h2>
      <ul id="expiredProductsList" class="list-unstyled" style="height: 150px; overflow-y: auto;">
      </ul>
</div>
    </div>
  </div>
</nav>


    
                <div class="header__toggle">
                    <i class='bx bx-menu' id="header-toggle"></i>
                </div>
            </div>
        </header>


        <!--========== NAV ==========-->
        <div class="nav" id="navbar">
            <nav class="nav__container" >
                <div>
             
                    <img src="crown.png" alt="" class="nav__icon1">
                  <b>  <span  class="header__logo">King's Coffee</span></b>
                       
                    <br>
                    <br>
                 

                    <div class="nav__list">
                        <div class="nav__items">
                            <?php if($_SESSION['login_type'] == 1):?>
    
                                <a href="index.php?page=home" class="nav__link ">
                                    <i class='bx bx-home-alt nav__icon'></i>
                                    <span class="text nav-text">Dashboard</span>
                                </a>
                            <?php endif;?>
                            <?php if($_SESSION['login_type'] == 2):?>
                                <a href="billing/index.php" class="nav__link ">
                                    <i class='bx bx-calculator nav__icon'></i>
                                        <span class="text nav-text">Take Order</span>
                                </a>
                            <?php endif;?>
                                <a href="index.php?page=ingredients" class="nav__link ">
                                    <i class='bx bx-book-open nav__icon'></i>
                                        <span class="text nav-text">Inventory</span>
                                </a>
                               
                            <div class="nav__dropdown">
                            <?php if($_SESSION['login_type'] == 1):?>
                                <a href="#" class="nav__link">
                                    <i class='bx bx-category-alt nav__icon' ></i>
                                    <span class="text nav-text">Categories</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="index.php?page=prod_categories" class="nav__dropdown-item">Product</a>
                                        <a href="index.php?page=ing_categories" class="nav__dropdown-item">Ingredient</a>
                                    </div>
                                </div>


                            </div>

                            <a href="index.php?page=products" class="nav__link ">
                                    <i class='bx bx-list-ul icon nav__icon'></i>
                                    <span class="text nav-text">Products</span>
                            </a>

                            <a href="index.php?page=orders" class="nav__link ">
                                <i class='bx bx-bar-chart-alt-2 nav__icon' ></i>
                                <span class="text nav-text">Sales</span>
                            </a>

                            <div class="nav__dropdown">
                                <a href="#" class="nav__link">
                                    <i class='bx bxs-report nav__icon' ></i>
                                    <span class="text nav-text">Reports</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                       <!-- <a href="index.php?page=sales_report" class="nav__dropdown-item"> Sales</a> -->
                                        <a href="index.php?page=stocks_report" class="nav__dropdown-item">Inventory Report</a>
                                        <a href="index.php?page=profit" class="nav__dropdown-item">Sales Report</a>
                                        <a href="index.php?page=top_selling" class="nav__dropdown-item">Top-Sell Report</a>
                                        <a href="index.php?page=voidreport" class="nav__dropdown-item">Void Report</a>
                                      
                                    </div>
                                </div>
                            </div>


                            <div class="nav__dropdown">
                                <a href="#" class="nav__link">
                                    <i class='bx bx-cog nav__icon' ></i>
                                    <span class="text nav-text">Setting</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="index.php?page=users" class="nav__dropdown-item"> User</a>
                                        <a href="index.php?page=user_log" class="nav__dropdown-item">User Log</a>
                                        <a href="index.php?page=archieve_categories" class="nav__dropdown-item">Archive</a>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                        </div>
                        <?php if($_SESSION['login_type'] == 2):?>
                            <div class="bottom-content">
                            <a href="javascript:void(0);" onclick="showPasswordPrompt()" class="nav__link">
                                  <i class='bx bx-receipt nav__icon'></i>
                               <span class="text nav-text">Drawer Change</span>
                                       
                                </a> 
                        <?php endif;?>

                      
                        <a href="ajax.php?action=logout" class="nav__link nav__logout">
                        <i class='bx bx-log-out nav__icon'></i>
                        <span class="text nav-text">Logout</span>
                        </a>
                        

                        </div>
                      

                    </div>


                </div>
            </nav>
        </div>
    



            



           




    <script>
        /*==================== SHOW NAVBAR ====================*/
const showMenu = (headerToggle, navbarId) =>{
    const toggleBtn = document.getElementById(headerToggle),
    nav = document.getElementById(navbarId)
    
    // Validate that variables exist
    if(headerToggle && navbarId){
        toggleBtn.addEventListener('click', ()=>{
            // We add the show-menu class to the div tag with the nav__menu class
            nav.classList.toggle('show-menu')
            // change icon
            toggleBtn.classList.toggle('bx-x')
        })
    }
}
showMenu('header-toggle','navbar')

/*==================== LINK ACTIVE ====================*/
const linkColor = document.querySelectorAll('.nav__link')

function colorLink(){
    linkColor.forEach(l => l.classList.remove('active'))
    this.classList.add('active')
}

linkColor.forEach(l => l.addEventListener('click', colorLink))







function showPasswordPrompt() {
            Swal.fire({
                title: 'Enter Password',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off',
                },
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                preConfirm: (password) => {
                    // Replace 'your_correct_password' with the actual correct password
                    if (password === 'test') {
                        Swal.fire('Success!', 'Password is correct.', 'success');
                        window.location.href = 'print_drawer.php';
                        
                    } else {
                        Swal.fire('Error', 'Incorrect password', 'error');
                    }
                }
            });
        }


        //NOTIFATION SCRIPT
        $(document).ready(function () {
  // Function to update the notification badge count
  function updateNotificationBadgeCount(count) {
    $("#notificationBadge").text(count);
  }

  // Function to fetch the count of expired products via AJAX
  function fetchExpiredProductCount() {
    $.ajax({
      url: 'expired_script.php', // Replace with the URL of your server-side script
      type: 'GET',
      success: function (data) {
        // Parse the response from the server
        var expiredProductCount = parseInt(data);

        // Update the notification badge count
        updateNotificationBadgeCount(expiredProductCount);
      },
      error: function (error) {
        console.log("Error fetching expired product count: " + error);
      }
    });
  }

  // Function to fetch and display the list of expired products
  function displayExpiredProducts() {
    $.ajax({
      url: 'expired_products.php', // Replace with the URL of your server-side script to fetch expired products
      type: 'GET',
      success: function (data) {
        // Parse the response from the server (assuming it's JSON data)
        var expiredProducts = JSON.parse(data);

        // Display the list of expired products
        var expiredProductsList = $("#expiredProductsList");
        expiredProductsList.empty(); // Clear any previous list items

        if (expiredProducts.length > 0) {
    expiredProducts.forEach(function (product, index) {
        // Assuming product is an object with 'name' and 'expiration_date' properties
        // Alternate row colors between beige and white
        var rowClass = (index % 2 === 0) ? 'beige-background' : 'white-background';
        expiredProductsList.append("<li class='" + rowClass + " border-beige white-text'>" + product.name + " (Expired on " + product.expiration_date + ")</li>");
    });
} else {
    expiredProductsList.append("<li>No expired products found</li>");
}

        // Show the container with the list of expired products
        $("#expiredProductsContainer").show();
      },
      error: function (error) {
        console.log("Error fetching expired products: " + error);
      }
    });
  }

  // Click event for the notification bell
  $("#notificationButton").click(function () {
    // Fetch and display the list of expired products
    displayExpiredProducts();
  });

  // Call the fetchExpiredProductCount function to update the badge count
  fetchExpiredProductCount();
});


    </script>

</body>
</html>