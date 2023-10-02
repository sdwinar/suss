<link rel="stylesheet" href="css/04usersshow.css">
<style>
body,
html {
    height: 100%;
    width: 100%;
    margin: 0;
    padding: 0;
    background: #e74c3c !important;
}

.searchbar {
    margin-bottom: auto;
    margin-top: auto;
    height: 60px;
    background-color: #353b48;
    border-radius: 30px;
    padding: 10px;
}

.search_input {
    color: white;
    border: 0;
    outline: 0;
    background: none;
    width: 0;
    caret-color: transparent;
    line-height: 40px;
    transition: width 0.4s linear;
}

.searchbar,
.search_input {
    padding: 5px 10px;
    width: 450px;
    caret-color: red;
    transition: width 0.4s linear;
    text-align: center;
}
</style>
<section id="homeusershowrowdiv" dir="<?php echo lang('rtl', 'ltr') ?>" style="    padding: 5px;">

    <div id="homeusershowdiv"></div>
    <div class="container h-100" style="padding: 0px 0px 19px 0px;">
        <div class="d-flex justify-content-center h-100">
            <div class="searchbar">
                <input class="search_input" type="text" id="homeusersserch"
                    placeholder="<?php echo lang('بحث عن طريق الاسم او اسم المستخدم', 'Search by name or username') ?>">
            </div>
        </div>
    </div>
    <div class="text-center">
        <a href="users?o=usersshow"><span class="badge badge-success col-6 badge-lg pull-center"
                style="    font-size: 14px;    font-weight: 700;    bottom: 10px;"><span
                    class=""><?php echo lang('مـشـاهـدة الـكـل', 'See all') ?></span></span>
        </a>
    </div>
</section>