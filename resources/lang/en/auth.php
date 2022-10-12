<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These Email or Password do not match our records.',
    'setHeaderLang' => 'please insert the Content-language header',
    'register'   => 'Register completed successfully please check your verifcation mail in your inbox',
    'email'    => 'this email not a real email please write a real one',
    'emailNotFound'    => 'the email is not found',
    'mustVerify'    => 'please go to your email for activate it and follow the instructions',
    'success'   => 'These E-mail and password are right and you logged in successfully',
    'failed2' => 'These E-mail or password do not match.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'logout' => 'you logged out successfully',
    'FB_login_ERR' =>"Error While Loading data Please try again Later .!",
    'hiUser' => "Dear, :Name",
    'profile' => "Profile",
    'save' => "Save",

    'fName' => 'First Name',
    'lName' => 'Last Name',
    'name' => 'Name',
    'userDetails' => 'User Data',
    'fullName' => 'Full Name',
    'phoneNumber' => 'Phone Number',
    'Email' => 'Email',
    'country' => 'Country',
    'city' => 'City',
    'flat' => 'flat / plot',
    'state' => 'Region/State',
    'address' => 'Address',
    'birthDate' => 'Birth Date',
    'postal_code' => 'Postal Code',
    'male' => 'Male',
    'female' => 'Female',
    'gender' => 'Gender',
    'street' => 'Street Name',
    'build_number' => 'Build Number',
    'PERSONAL DETAIL'=>'Personal Details',
    'saveSetting'=>'Save setting',
    'saveChanges' => 'Save Changes',
    'addNewAddress' => 'Add New Address',
    'successNewSetting' => 'New :var Created Successfully',
    'successSetting' => 'User Data Updated Successfully.',
    'successUpdate' => ':var Data Updated Successfully.',
    'errorSetting' => 'Error While Updating data Please try again Later .!',
    'errorNewSetting' => 'Error While Inserting data Please try again Later .!',
    'EmailNotExist' => 'This Email ib',
    'UserNotExist' => 'This User is Not Exist!.',
    'EmailErr'=>'This Email is Not Correct!.',
    'restPWSend'      => 'Your password recovery details have been sent to your email!.',
    'active' => 'Active',
    'inActive' => 'InActive',
    'passwordMin'=>"Password Can't Be Less Than 8 Characters",
    'errPassword' => 'This Password is Not Correct !',
    'notSamePW'=>'Password Not Matched',

    'tSuccess' => 'Success',
    'tError' => 'Error',

    'create' => 'Create',
    'edit' => 'Edit',

    'remMe'=> 'Remember Me',
    'mapPlaceHolder'=> 'Enter the address or the name of the area to search',
    'currentLocation' => 'Current Location',
    'changePass' => 'Change Password',
    'editProfile' => 'Update My Profile',
    'SHIPPING ADDRESS'=>'Shipping Addresses',
    'new SHIPPING ADDRESS'=>'New Shipping Addresses Created Successfully.!',
    'myAccount'=>'My Account',
    'myOrders'=>'My Orders',

    'addressReq' =>'User Address is Required',
    'emailReq' =>'Email Address is Required',
    'contact_numberMin' =>"Phone Number Less Than 11 Numbers",
    'contact_numberReq' =>'Phone Number is Required',

    'cityReq' =>'City is Required',
    'stateReq' =>'State is Required',

    'postalNum' =>'Postal Code not Correct',
    'birthDate_date_format' =>'Birth Date not Correct',

    'error_Emp' => ':var can`t Be Empty!.',
    'error_min' => 'The :var must be at least :num characters :more.',
    'error_max' => 'The :var must be no more than :num characters :more.',
    'or_more' => 'or leave it empty.',

    'title' => 'Title',
    'subTitle' => 'Subtitle',
    'description' => 'Description',

    'emailOrPhone'=> 'Email Or Phone',

    "FN_req" => "First Name is Required",
    "LN_req" => "Last Name is Required",

    "userVerify" => "Verify Your Account.!",
    "Submit" => "Submit",
    "fax" => "Fax",
    "accountError" => "This Account Not Found.",
    "emailExist" => "This User Email Account Already Exist.",
    "errorVerify" => "This Verification Code is Not Correct.",
    "Verify" => "Login Verification Code is Required.",
    "enterVerify" => "Login Account Verification Code.",
    "resendVerify" => "Resend Verification Code.",
    "sendSuccess" => "Login Verification Code Resent Successfully",
    "userSuccess" => "New User Account Created Successfully, and You Can Login Now",

    'send'=>'Send',

    "subscribeSuccess" => "Email Subscribed Successfully",
    "subscribeError" => "Error while Saving Email Try Again Later.!",

    'orderNotFound' => 'error while create your order, you can try again later!',

    'uniqueErr' => 'This :var has already been used before.',

    'editSetting' => 'Setting',

    'Password'=>'Password',
    'userRegister' => 'Create New User',
    'haveAccount' => 'Account Already Exist.!',
    'haveAccount?' => 'Already hav an account?',
    'passwordChangedSuccess'=>'Password changed successfully.',
    'sendResetPWDLink' => 'Send Reset Password Link',

    'userName' => 'Username',

    'workPlace' => 'Present employer',
    'NID'=>'National ID',
    'image'=>'Profile Image',
    'age'=>'Age',
    'imgErrorType'=>'Image Extension Must be like [ JPG, PNG, JPEG ] .!',

    'national_idMin' => 'National Id Can`t Be Lees Than 14 Number.',

    'national_idNum' => 'National Id Not Correct.',

    'imageMax' => 'Image Size Can`t Be More Than 2MB.',


    'ageNum' => 'Age Must Be in Numeric Value.',
    'pwConfirm'=>'Confirm Password',
    'error_Num' => ':var is not Correct, Must Be Numbers.',
    'error_Num2' => ':var is not valid or taken.',

    'forgetPW?'=> 'Forgot password?',

    'orderSuccess'=>
        config('setting.pricing')
            ? 'Your Order has been saved successfully.'
            : 'The price request has been saved successfully, and the administration will respond to your request, Soon.',
    'restLinkError'=>'This Reset Password Link Is Not Correct Enter Your Email To Send a New Link.',
    'forgetLink'=>'This Forget Password Link was Sent Successfully.',

    'sellerDestroyCount' => 'This Seller Can\'t Delete ',

    'loginAsSeller' => 'Login As Seller',
    'loginWord' => 'Login To Your Account',
    'loginHave?' => 'Dont have account account? ',
);
