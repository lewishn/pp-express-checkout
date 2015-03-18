<?php

	function pg_connection_string_from_database_url() {
 		extract(parse_url($_ENV["DATABASE_URL"]));
 		return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
	}
	
	
	$pg_conn = pg_connect(pg_connection_string_from_database_url());
	
	$result = pg_query($pg_conn, "SELECT relname FROM pg_stat_user_tables WHERE schemaname='public'");
	print "<pre>\n";
	if (!pg_num_rows($result)) {
  		print("Your connection is working, but your database is empty.\nFret not. This is expected for new apps.\n");
	} else {
  		print "Tables in your database:\n";
  		while ($row = pg_fetch_row($result)) { print("- $row[0]\n"); }
	}
?>