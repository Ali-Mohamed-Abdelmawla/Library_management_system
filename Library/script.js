var win;
function opennew()
{
    win = open("child win.html","", "width=500,height=500")
}
function Close() 
{
    win.close();  
}
function Changebkcol()
{
    win.backgroundcolor = "red";
    win.focus();
} 
function Gotolog()
{
    window.location.href = "login_page.php";
}
function Gotoregister()
{
    window.location.href = "Register_page.php";
}