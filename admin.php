<?php
require_once("./php/is_logged_in.php");
require_once("./php/db_connect.php");
require_once("./php/logout.php");
include_once("./php/all_biodata.php");
include_once("./php/delete_user.php");
$base_img_url = "https://ghotok.soft-techtechnology.com/uploads/"; //need to change with real domain
$base_img_url2 = "http://localhost/"; //need to change with real domain
include_once("./php/change_bio_status.php");
include_once("./php/single_bio.php");
include_once("./php/all_transactions.php");
include_once("./php/add_advertise.php");
include_once("./php/all_advertise.php");
include_once("./php/change_ad_status.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin.css" />
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <!-- sweet alert cdn -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <!-- Sidebar -->
  <aside id="sidebar">
    <div class="logo">
      <h2><i class="fa-solid fa-user-gear"></i> Admin</h2>
      <button id="closeSidebar"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <nav>
      <a href="#" class="nav-link active" data-target="users"><i class="fa-solid fa-users"></i> All Users</a>
      <a href="#" class="nav-link" data-target="biodatas"><i class="fa-solid fa-address-card"></i> All Biodatas</a>
      <a href="#" class="nav-link" data-target="transactions"><i class="fa-solid fa-credit-card"></i> Transactions</a>
      <a href="#" class="nav-link" data-target="advertisement"><i class="fa-solid fa-bullhorn"></i> Advertisement</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <main id="main-content">
    <header>
      <button id="menuBtn"><i class="fa-solid fa-bars"></i></button>
      <h1>Admin Dashboard</h1>
      <a href="?logout=true" class="status-btn inactive" style="max-width: 90px;">Logout</a>
    </header>

    <!-- USERS -->
    <section id="users" class="content-section active">
      <h2>All Users</h2>
      <div class="card-container users-grid">
        <?php
        if ($all_users && count($all_users) > 0) {
          foreach ($all_users as $user) {
            $created_at = explode(" ", $user["created_at"])[0];
            $user_image = "$base_img_url" . $user["profile_picture"];
            echo "
          <div class='user-card'>
          <img
            src='$user_image'
            alt='User' />
          <h3>{$user["full_name"]}</h3>
          <p><b>ID:</b> <span>{$user["id"]}</span></p>
          <p><b>District:</b> <span>{$user["district"]}</span></p>
          <p><b>Created:</b> <span>{$created_at}</span></p>
          <p><b>Email:</b> <span><a href='mailto:{$user["user_id"]}' style='color:black; text-decoration:none'>Email</a></span></p>
          <div class='actionButtons'>
            <a href='#' onClick={handleUserDelete('{$user["user_id"]}')} class='status-btn inactive'>Delete</a>
          </div>
        </div>
            
            ";
          }
        }

        ?>
        <!-- Example cards -->

      </div>
    </section>

    <!-- BIODATAS -->
    <div class="table-container">
      <section id="biodatas" class="content-section">
        <h2>All Biodatas</h2>
        <table class="data-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Gender</th>
              <th>Age</th>
              <th>Marital Status</th>
              <th>Status</th>
              <th>Action</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($all_users && count($all_users) > 0) {
              foreach ($all_users as $bio) {
                $action_btn = ($bio["status"] == "active") ? "<a href='?inactive_bio={$bio["user_id"]}' class='status-btn inactive'>Inactive</a>" : " <a href='?active_bio={$bio["user_id"]}' class='status-btn active'>Active</a>";
                echo "
             <tr>
            <td>{$bio["id"]}</td>
            <td>{$bio["full_name"]}</td>
            <td>{$bio["email"]}</td>
            <td>{$bio["gender"]}</td>
            <td>{$bio["age"]}</td>
            <td class='capitalize'>{$bio["marital_status"]}</td>
            <td class='capitalize'>{$bio["status"]}</td>
            <td>
              $action_btn
            </td>
            <td>
              <a href='?view={$bio["user_id"]}' class='view-btn'>View</a>
            </td>
          </tr>
                
                ";
              }
            }

            ?>

          </tbody>
        </table>
      </section>
    </div>
    <!-- TRANSACTIONS -->
    <section id="transactions" class="content-section">
      <h2>Transactions</h2>
      <div class="table-container">
        <table class="data-table">
          <thead>
            <tr>
              <th>User ID</th>
              <th>Txn ID</th>
              <th>Payment For</th>
              <th>Interested ID</th>
              <th>Amount</th>
              <th>Date</th>
              <th>Status</th>
              <th>Merchant Invoice</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($all_transactions) && count($all_transactions) > 0) {
              foreach ($all_transactions as $transaction) {
                echo "<tr>
                        <td>{$transaction["id"]}</td>
                        <td>{$transaction["txn_id"]}</td>
                        <td class='capitalize'>{$transaction["payment_for"]}</td>
                        <td>{$transaction["interested_id"]}</td>
                        <td>{$transaction["amount"]} TK</td>
                        <td>{$transaction["txn_date"]}</td>
                        <td class='capitalize'>{$transaction["status"]}</td>
                        <td>{$transaction["merchant_invoice"]}</td>
                      </tr>";
              }
            }
            ?>

          </tbody>
        </table>
      </div>
    </section>

    <!-- ADVERTISEMENT -->
    <section id="advertisement" class="content-section">
      <h2>Advertisement</h2>
      <form action="" class="ad-form" method="post" enctype="multipart/form-data">
        <h3>Add New Advertisement</h3>
        <input type="text" name="ad_title" placeholder="Ad Title" required />
        <input type="url" name="ad_link" placeholder="Ad Link" required />
        <input type="file" name="ad_image" required />
        <button type="submit">Add Advertisement</button>
        <p style="text-align: center; font-weight: bold;color:green">
          <?php
          echo htmlspecialchars($success);
          ?>
        </p>

      </form>
      <div class="ads-section">
        <?php
        if (isset($all_advertises) && count($all_advertises) > 0) {
          foreach ($all_advertises as $advertise) {
            $advertise_image = $base_img_url2 . $advertise["ad_image"];
            $advertise_action_btn = ($advertise["status"] === "active") ? " <a href='?ad_inactive={$advertise["id"]}' class='status-btn inactive'>Inactive</a>" : " <a href='?ad_active={$advertise["id"]}' class='status-btn active'>Active</a>";
            echo "<div class='ad-card'>
                <a href='{$advertise["ad_link"]}' target='_blank'>
                  <img
                    src='$advertise_image'
                    alt='Ad' /></a>
                <p>Ad Title: {$advertise["ad_title"]}</p>
                <p class='capitalize'>Ad Status: {$advertise["status"]}</p>
                <div class='advertiseInactive'>
                 $advertise_action_btn
                </div>
              </div>";
          }
        }
        ?>
      </div>
    </section>
  </main>

  <!-- MODAL -->
  <!-- PERSON DETAILS MODAL -->
  <?php if (isset($target_bio["user_id"]) && !empty($target_bio["user_id"])): ?>
    <div id="modal">
      <div class="modal-content">
        <a href="./admin.php" id="closeModal" class="close-btn">
          <i class="fa-solid fa-xmark"></i>
        </a>

        <div class="person-details">
          <!-- Profile Header -->
          <div class="profile-header">
            <img
              src="<?php echo $base_img_url . $target_bio["profile_picture"] ?>"
              alt="Profile" />
            <div class="profile-basic">
              <h2><?php echo htmlspecialchars($target_bio["full_name"] ?? "") ?> <span class="id">ID: <?php echo htmlspecialchars($target_bio["id"] ?? "") ?></span></h2>
              <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($target_bio["present_address"] ?? "") ?></p>
            </div>
          </div>

          <div class="personDetailsLowerContainer">
            <div class="pdlcleft">
              <!-- Image Gallery -->
              <div class="personImageGallery">
                <div class="pigMain">
                  <img
                    id="mainImageProfile"
                    src="<?php echo $base_img_url . $target_bio["profile_picture"] ?>"
                    alt="main image" />
                </div>

                <div class="pigsub">
                  <img
                    onclick="handleProfileImg(this)"
                    src="<?php echo $base_img_url . $target_bio["other_img_one"] ?>"
                    alt="subImage" />
                  <img
                    onclick="handleProfileImg(this)"
                    src="<?php echo $base_img_url . $target_bio["other_img_two"] ?>"
                    alt="subImage" />
                  <img
                    onclick="handleProfileImg(this)"
                    src="<?php echo $base_img_url . $target_bio["other_img_three"] ?>"
                    alt="subImage" />
                </div>
              </div>

              <!-- Basic Details -->
              <div class="info-section">
                <h3><i class="fas fa-user"></i> Basic Details</h3>
                <ul>
                  <li><strong>Full Name:</strong> <?php echo htmlspecialchars($target_bio["full_name"] ?? "") ?></li>
                  <li><strong>Age:</strong> <?php echo htmlspecialchars($target_bio["age"] ?? "") ?> Years</li>
                  <li><strong>Height:</strong> <?php echo htmlspecialchars($target_bio["height"] ?? "") ?></li>
                  <li><strong>Gender:</strong> <?php echo htmlspecialchars($target_bio["gender"] ?? "") ?></li>
                  <li><strong>Marital Status:</strong> <?php echo htmlspecialchars($target_bio["marital_status"] ?? "") ?></li>
                  <li>
                    <strong>Father's Name:</strong> <?php echo htmlspecialchars($target_bio["fathers_name"]) ?>
                    <span>(<?php echo htmlspecialchars($target_bio["fathers_status"] ?? "") ?>)</span>
                  </li>
                  <li>
                    <strong>Mother's Name:</strong> <?php echo htmlspecialchars($target_bio["mothers_name"] ?? "") ?>
                    <span>(<?php echo htmlspecialchars($target_bio["mothers_status"] ?? "") ?>)</span>
                  </li>
                </ul>
              </div>

              <!-- Professional Info -->
              <div class="info-section">
                <h3>
                  <i class="fas fa-briefcase"></i> Professional Information
                </h3>
                <ul>
                  <li><strong>Education:</strong> <?php echo htmlspecialchars($target_bio["education"] ?? "") ?></li>
                  <li><strong>Profession:</strong> <?php echo htmlspecialchars($target_bio["profession"] ?? "") ?></li>
                  <li><strong>Monthly Income:</strong> <?php echo htmlspecialchars($target_bio["monthly_income"] ?? "") ?>৳</li>
                </ul>
              </div>

              <!-- Family Details -->
              <div class="info-section">
                <h3><i class="fas fa-users"></i> Family Details</h3>
                <ul>
                  <li><strong>Siblings:</strong> <?php echo htmlspecialchars($target_bio["siblings"] ?? "") ?></li>
                  <li><strong>Position Among Siblings:</strong> <?php echo htmlspecialchars($target_bio["child_order"] ?? "") ?></li>
                </ul>
              </div>

              <!-- Quick Intro -->
              <div class="info-section">
                <h3><i class="fas fa-id-card"></i> Overview</h3>
                <p>Name: <?php echo htmlspecialchars($target_bio["full_name"] ?? "") ?>, Age: <?php echo htmlspecialchars($target_bio["age"]) ?> Years</p>
                <p>Education: <?php echo htmlspecialchars($target_bio["education"] ?? "") ?> | Profession: <?php echo htmlspecialchars($target_bio["profession"] ?? "") ?></p>
                <p>Height: <?php echo htmlspecialchars($target_bio["height"] ?? "") ?> | Skin Color: <?php echo htmlspecialchars($target_bio["skin_color"] ?? "") ?></p>
                <p>
                  <strong>A Few Lines About John Doe:</strong> <?php echo htmlspecialchars($target_bio["about"]) ?>
                </p>
              </div>
            </div>

            <div class="pdlcright">
              <div class="info-section">
                <h3><i class="fas fa-phone"></i> Contact Details</h3>
                <ul>
                  <li><strong>Phone:</strong> <?php echo htmlspecialchars($target_bio["phone"] ?? "") ?></li>
                  <li><strong>Email:</strong> <?php echo htmlspecialchars($target_bio["email"] ?? "") ?></li>
                  <li><strong>Address:</strong> <?php echo htmlspecialchars($target_bio["present_address"] ?? "") ?></li>
                  <li><strong>District:</strong> <?php echo htmlspecialchars($target_bio["district"] ?? "") ?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  <?php endif; ?>


  <!-- script for delete user -->
  <script>
    // handle delete user
    const handleUserDelete = (id) => {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          setTimeout(() => {
            window.location.href = `?delete_user=${id}`
          }, 200);

        }
      });
    };
  </script>

  <script src="admin.js"></script>

</body>

</html>