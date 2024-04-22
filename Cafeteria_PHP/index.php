<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("Location:src/view/website/login.php");
}
require "./src/controller/website/ProductController.php";
// require "./gallery/w.jpg"
?>

<!-- add search button  -->
<nav class='navbar navbar-expand-lg navbar-light bg-dark col-12 '>
    <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="#"><?=$_SESSION['username']?></a>
    
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost/Cafeteria_php/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/Cafeteria_php/src/view/website/myorder.php">Myorder</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="http://localhost/Cafeteria_php/src/controller/website/UserController.php?logout=1" >Logout</a>
        </li>
      </ul>
        <form class="d-flex" method="post">
            <input class="form-control me-2 border-warning" name="dataSearch" type="search" placeholder="Search"
                aria-label="Search">
            <button class="btn btn-outline-success" name="search">Search</button>
        </form>
        
    </div>
</nav>


  



<!-- section of retriving data to table and send to order page  -->
<!-- contain form and inside form table and make in td inputs to can send data in $post -->


<!-- ========================== TABLE CART OF PRODUCT ====================================== -->

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-3 ">
            <form method='post'>
                <table class="table">
                    <th>name</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>Image</th>

                    <?php
                    if (isset($_SESSION['cart'])) {
                        $prod = new Product();
                        echo "<tr>";
                        $total = 0;
                        foreach ($_SESSION['cart'] as $value) {
                            $singleProduct = $prod->selectBasedCondetion("id={$value}");
                            echo "<td><input class='form-control' name='productName[]' type='text' value='{$singleProduct['name']}' readonly style='border: none;'></td>";
                            echo "<td><input class='form-control' name='productPrice[]' type='text' value='{$singleProduct['price']}' readonly style='border: none;'></td>";
                            echo "<td><input class='form-control' name='productQantity[]' type='number' value='1' readonly style='border: none;'></td>";
                            echo " <td><img width='50px' height='50px' src='src/views/dashboard/ProductImage/{$singleProduct['image']}'  </td> ";
                            echo "</tr>";
                            $total += $singleProduct['price'];
                        }
                    }
                    echo " </table>";
                    echo "<div class=' border-2 black-border-top' style='border-top: 2px solid black;'>
                </div>";

                    if (isset($total)) {
                        echo "<strong >Total price : {$total}</strong>";
                        echo "<input type='hidden' name='total' value='{$total}' readonly>";
                    }


                    echo "<textarea class='form-control col-md-6' name='notes' rows='1' placeholder='Enter your notes'></textarea>";
 
 //============================================= drop down for room ===============================
                    $room = new Room();
                    $rooms = $room->getAll_Room();

                    echo "<strong><label for='room' class='form-label'>Choose a room:</label></strong>";
                    echo "<select class='form-select' name='room' id='room'>";
                    foreach ($rooms as $room) {
                        echo "<option value='{$room['name']}'>{$room['name']}</option>";
                    }
                    echo "</select>";

                    //==========================END drop down for room =====================
                    

                    echo " <div class='mt-2'>";
                    echo "<input class='btn btn-dark' type='submit' name='confirm_order' value='Confirm Order'> 
                     </form>";
                    echo " </div>";
                    ?>
        </div>
        <!-- ALL THIS CODE MIX BET DISEGN AND RETRIVING DATA  -->

        <!-- ========================== END CART OF PRODUCT ====================================== -->






        <!--========================== displaying card product and inject data =================== -->

        <div class="col-9 ">
            <div class='row'>
                <?php
                foreach ($data as $value) {
                    $cat = new Product();
                    $catName = $cat->getCategoryName($value['category_id']);
                    $catName = implode("", $catName);
                    echo
                        "
        <div class='card mt-2 text-center' style='width: 14rem;'>
            <img src='src/views/dashboard/ProductImage/{$value['image']}' width='50px' height='50px' class='card-img-top mt-2' >
            <div class='card-body'>
                <h5 class='card-title'>Name :{$value['name']}</h5>
                <p class='card-text'>price : {$value['price']}</p>
                <p>category : $catName </p>
                
                 <a href='?id={$value['id']}' class='btn btn-dark addToCart' data-id='{$value['id']}'>Add to cart</a>                
         </div>
        </div>";

         }
                ?>

            </div>

        </div>

    </div>

</div>

         <!--========================== END displaying card product and inject data ========================== -->






<!--============ MAKING AJAX ================= -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var addToCartButtons = document.querySelectorAll('.addToCart');
        addToCartButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                var id = this.getAttribute('data-id');
                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log("Item added to cart.");
                            location.reload();
                        } else {
                            console.error("Error adding item to cart:", xhr.status, xhr.statusText);
                        }
                    }
                };

                xhr.open('GET', '?id=' + id, true);
                xhr.send();
            });
        });
    });
</script>


<script>

    function increment() {
        var inputElement = document.getElementById("input");
        if (inputElement.value > x) { }

        else {
            var value = parseInt(inputElement.value);
            x++;
            inputElement.value = x;
        }

    }

    function decrement() {

        var inputElement = document.getElementById("input");
        if (inputElement.value == 0) {

        } else {
            var value = parseInt(inputElement.value);
            x--;
            inputElement.value = value;
        }

    }
</script>

</body>

</html>
</body>

</html>
