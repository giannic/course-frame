#!/bin/sh
cp php_pages/* .
rm index.html exams.html projects.html
php index.php > index.html
php exams.php > exams.html
php projects.php > projects.html
rm index.php exams.php projects.php
