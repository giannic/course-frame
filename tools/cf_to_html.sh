#!/bin/sh
php index.php > index.html
php exams.php > exams.html
php projects.php > projects.html
mkdir -p php_pages
mv index.php exams.php projects.php php_pages
