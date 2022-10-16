var d = new Date();
var date = d.getUTCDate();
var month = d.getUTCMonth() + 1; // Since getUTCMonth() returns month from 0-11 not 1-12
var year = d.getUTCFullYear();

var dateStr = date + "/" + month + "/" + year;
document.getElementById("date").innerHTML = dateStr;

setInterval(myTimer, 1000);

function myTimer() {
    const t = new Date();
    document.getElementById("time").innerHTML = t.toLocaleTimeString();

}

function changeColour(theme) {
    if (theme === "dark") {
        document.getElementById("background").style.backgroundColor = "black";
        document.getElementById("background").style.color = "white";
    } else {
        document.getElementById("background").style.backgroundColor = "rgb(162, 205, 207)";
        document.getElementById("background").style.color = "black";
    }
}
// ------- ADMIN ---------------
function DeleteUser(uid) {
    if (confirm("You want to delete this user?" + uid)) {
        console.log("user id is " + uid);
        window.location.href = "delete_user.php?uid=" + uid;
    }
}

function DeletePost(pid) {
    if (confirm("You want to delete this post?" + pid)) {
        window.location.href = "delete_post.php?postid=" + pid;
    }
}

function UpdateUser(uid) {
    if (confirm("You want to Update this user?" + uid)) {
        console.log("user id is " + uid);
        window.location.href = "update_user.php?uid=" + uid;
    }
}

function UpdatePost(pid) {
    if (confirm("You want to Update this post?" + pid)) {
        console.log("post id is " + pid);
        window.location.href = "update_post.php?postid=" + pid;
    }
}

function AdminDeletePost(pid) {
    if (confirm("You want to delete this post?" + pid)) {
        window.location.href = "delete_admins_posts.php?postid=" + pid;
    }
}

function AdminUpdatePost(pid) {
    if (confirm("You want to Update this post?" + pid)) {
        console.log("post id is " + pid);
        window.location.href = "update_admins_posts.php?postid=" + pid;
    }
}

// ---------------USER------------------

function DeleteUserPost(pid) {
    if (confirm("You want to delete this post?" + pid)) {
        window.location.href = "delete_user_post.php?postid=" + pid;
    }
}

function UpdateUserPost(pid) {
    if (confirm("You want to Update this post?" + pid)) {
        console.log("post id is " + pid);
        window.location.href = "update_user_post.php?postid=" + pid;
    }
}

function changeTheme() {
    href = document.getElementById("stylesheet").getAttribute("href");
    console.log(href);
    currentColour = href.includes("dark");
    console.log(currentColour);
    styleLink = "";
    if (!currentColour) {
        document.getElementById("stylesheet").setAttribute("href", "css/style-dark.css");
        // a variable equal to 
        styleLink = "css/style-dark.css";
    } else {
        document.getElementById("stylesheet").setAttribute("href", "css/style.css");
        styleLink = "css/style.css";
    }
    // use jquery to post to the header script the value we set in href
    $.post("header.php", { theme: styleLink })
        .done(function(data) {
            console.log("Theme preference posted");
        });

}

$(document).ready(function() {
    $("#fontSelector").change(function() {
        $("body").css("font-family", $(this).val());
    });
});

$(document).ready(function() {
    $("#fontSize").change(function() {
        $("body").css("font-size", $(this).val());
    });
});