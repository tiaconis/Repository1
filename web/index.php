
<?php
# This function reads your DATABASE_URL configuration automatically set by Heroku
# the return value is a string that will work with pg_connect
function pg_connection_string() {
    return "dbname=de3i2cq1h2f7f4 host=ec2-107-20-197-146.compute-1.amazonaws.com port=5432 user=zkhihxyfycdqwh password=2_1RgO1v-ViUlF7M4XuZLYXDM2 sslmode=require";
}
 
# Establish db connection
$db = pg_connect(pg_connection_string());
if (!$db) {
    echo "Database connection error."
    exit;
}
 
$result = pg_query($db, "SELECT statement goes here");
?>

