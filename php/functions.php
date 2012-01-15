<?php
define('ISCLI', PHP_SAPI === 'cli'); //check mode

function nav() {
         $suffix = ".php";
         if (ISCLI) {
            $suffix = ".html";
         }
         echo "<nav>";
              echo "<a href='index$suffix'>Home</a>";

              $syllabi = glob("syllabus*");
              if ($syllabi && ($syllabus = $syllabi[0])) {
                 echo "<a href='$syllabus' target='_blank'>Syllabus</a>";
              }

              echo "<a href='projects$suffix'>Projects</a>";
              echo "<a href='exams$suffix'>Exams</a>";
         echo "</nav>";
}

function course_title() {
         $info = 'course.info';
         if (file_exists($info) && is_readable($info)) {
            if (($info_fh = fopen($info, 'r'))) {
                  $line = fgets($info_fh);
                  $toks = explode(": ", $line);
                  if ($toks[0] == "Course Code") {
                     echo $toks[1];
                  }
                  $line = fgets($info_fh);
                  $toks = explode(": ", $line);
                  if ($toks[0] == "Course Name") {
                     echo " - $toks[1]";
                  }
                  fclose($info_fh);
            }
         } else {
           echo "Your course";
         }
}

function get_info() {
         $info = 'course.info';
         if (file_exists($info) && is_readable($info)) {
            if (($info_fh = fopen($info, 'r'))) {
               echo "<p>";
               while (!feof($info_fh)) {
                     $line = fgets($info_fh);
                     $toks = explode(": ", $line);
                     if ($toks[0] == "Course Code" || $toks[0] == "Course Name") {
                        continue;
                     } else if ($toks[0] == "Description") {
                        echo "$toks[0]:<br/>$toks[1]<br/>";
                     } else {
                        echo "$line<br/>";
                     }
               }
               echo "</p>";
               fclose($info_fh);
            }
         }
}

function get_announcements() {
         $announce_file= 'announcements.info';
         if (file_exists($announce_file) && is_readable($announce_file)) {
            if (($announce_fh = fopen($announce_file, 'r'))) {
               while (!feof($announce_fh)) {
                     $line = fgets($announce_fh);
                     echo "$line<br/>";
                     $line = fgets($announce_fh); //prone to breaking
                     echo "$line<br/><br/>";
               }
               fclose($announce_fh);
            }
         }

}

function get_directory($basedir) {
         if (file_exists($basedir) && is_dir($basedir)) {
            if (($base_dh = opendir($basedir))) {
               while (($entry_dir = readdir($base_dh)) !== false) {
                     if (is_dir("$basedir/$entry_dir")) {
                        if ($entry_dir == ".." || $entry_dir == ".") {
                           continue; //do not include parent and self
                        }

                        if (($dir_dh = opendir("$basedir/$entry_dir"))) {
                           echo $entry_dir."<br/>";
                           while (($entry = readdir($dir_dh)) !== false) {
                              if ($entry == ".." || $entry == ".") {
                                 continue;
                              }
                              echo "<a href='$basedir/$entry_dir/$entry'>$entry</a><br/>";
                           }
                           echo "<br/>";
                           closedir($dir_dh);
                        }
                     }
               }
               closedir($base_dh);
            }
         }
}

?>