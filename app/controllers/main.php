<?php

function renderHome() {
  require VIEW_PATH . 'main/home.php';
}

function renderJobs() {
  require VIEW_PATH . 'main/jobs.php';
}

function renderPeople() {
  require VIEW_PATH . 'main/people.php';
}

function renderAbout() {
  require VIEW_PATH . 'static/about.php';
}

function renderContact() {
  require VIEW_PATH . 'static/contact.php';
}
