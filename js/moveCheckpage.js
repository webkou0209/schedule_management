function move_checkpage() {
    let d = new Date();
    let year = d.getFullYear();
    let month = d.getMonth() + 1;
    let url = "./check.php?year=" + year + "&month=" + month;
    location.href = url;
  }