<?php

/** CSI 418
Modified from my CS410 - Intro to Databases Final Project
  *
  * This file was included in the cited tutorial to store functions for later use
  * Here, we store an HTML escape function
  */

function escape($html) {
  return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
