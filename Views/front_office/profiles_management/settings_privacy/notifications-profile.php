<?php
require_once __DIR__ . '/../../../../Controls/profileController.php';


// Check if the request method is GET and if id_emp is set in the URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['profile_id'])) {
    // Retrieve the profilee information from the database
    $id = $_GET['profile_id'];

    // Create an instance of the controller
    $profileController = new ProfileC();

    // Get the profilee details by ID
    $profile = $profileController->getProfileById($id);

    // Check if profile is set and not null
    if ($profile) {
        // profilee details are available, proceed with displaying the form
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/notifications_profile.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'>
    <title>Notifications</title>
</head>

<body>
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link  ms-0" href="./edit-profile.php?profile_id=<?php echo $profile['profile_id'] ?>"" target="__blank">Profile</a>
            <a class="nav-link" href="./billing-profile.php?profile_id=<?php echo $profile['profile_id'] ?>"" target="__blank">Billing</a>
            <a class="nav-link" href="./security-profile.php?profile_id=<?php echo $profile['profile_id'] ?>"" target="__blank">Security</a>
            <a class="nav-link active" href="./notifications-profile.php?profile_id=<?php echo $profile['profile_id'] ?>"" target="__blank">Notifications</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-lg-8">
                <!-- Email notifications preferences card-->
                <div class="card card-header-actions mb-4">
                    <div class="card-header">
                        Email Notifications
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="flexSwitchCheckChecked" type="checkbox" checked="">
                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <!-- Form Group (default email)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputNotificationEmail">Default notification email</label>
                                <input class="form-control" id="inputNotificationEmail" type="email" value="name@example.com" disabled="">
                            </div>
                            <!-- Form Group (email updates checkboxes)-->
                            <div class="mb-0">
                                <label class="small mb-2">Choose which types of email updates you receive</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkAccountChanges" type="checkbox" checked="">
                                    <label class="form-check-label" for="checkAccountChanges">Changes made to your account</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkAccountGroups" type="checkbox" checked="">
                                    <label class="form-check-label" for="checkAccountGroups">Changes are made to groups you're part of</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkProductUpdates" type="checkbox" checked="">
                                    <label class="form-check-label" for="checkProductUpdates">Product updates for products you've purchased or starred</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkProductNew" type="checkbox" checked="">
                                    <label class="form-check-label" for="checkProductNew">Information on new products and services</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkPromotional" type="checkbox">
                                    <label class="form-check-label" for="checkPromotional">Marketing and promotional offers</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="checkSecurity" type="checkbox" checked="" disabled="">
                                    <label class="form-check-label" for="checkSecurity">Security alerts</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- SMS push notifications card-->
                <div class="card card-header-actions mb-4">
                    <div class="card-header">
                        Push Notifications
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="smsToggleSwitch" type="checkbox" checked="">
                            <label class="form-check-label" for="smsToggleSwitch"></label>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <!-- Form Group (default SMS number)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputNotificationSms">Default SMS number</label>
                                <input class="form-control" id="inputNotificationSms" type="tel" value="123-456-7890" disabled="">
                            </div>
                            <!-- Form Group (SMS updates checkboxes)-->
                            <div class="mb-0">
                                <label class="small mb-2">Choose which types of push notifications you receive</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkSmsComment" type="checkbox" checked="">
                                    <label class="form-check-label" for="checkSmsComment">Someone comments on your post</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkSmsShare" type="checkbox">
                                    <label class="form-check-label" for="checkSmsShare">Someone shares your post</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkSmsFollow" type="checkbox" checked="">
                                    <label class="form-check-label" for="checkSmsFollow">A user follows your account</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkSmsGroup" type="checkbox">
                                    <label class="form-check-label" for="checkSmsGroup">New posts are made in groups you're part of</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="checkSmsPrivateMessage" type="checkbox" checked="">
                                    <label class="form-check-label" for="checkSmsPrivateMessage">You receive a private message</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Notifications preferences card-->
                <div class="card">
                    <div class="card-header">Notification Preferences</div>
                    <div class="card-body">
                        <form>
                            <!-- Form Group (notification preference checkboxes)-->
                            <div class="form-check mb-2">
                                <input class="form-check-input" id="checkAutoGroup" type="checkbox" checked="">
                                <label class="form-check-label" for="checkAutoGroup">Automatically subscribe to group notifications</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" id="checkAutoProduct" type="checkbox">
                                <label class="form-check-label" for="checkAutoProduct">Automatically subscribe to new product notifications</label>
                            </div>
                            <!-- Submit button-->
                            <button class="btn btn-danger-soft text-danger">Unsubscribe from all notifications</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>

</body>

</html>

<?php
    } else {
        // profilee not found or null, handle this case
        echo "profile not found or null";
    }
} else {
    // Invalid request, handle this case
    echo "Invalid request";
}
?>