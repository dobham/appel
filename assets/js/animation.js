//var bubbleMove = 0;
//var bubble1 = document.getElementById("bubble1");
/* window.onload = function(){
    while (bubbleMove <= 900){
        bubble1.style.left = bubbleMove + 'px';
        bubbleMove +=1;
}*/
               
window.onload = function one() {
    startSetTimeoutAnimation();
    startSetTimeoutAnimation2();
    startSetTimeoutAnimation3();
    startSetTimeoutAnimation4();
    startSetTimeoutAnimation5();
    startSetTimeoutAnimation6();
    startSetTimeoutAnimation7();
    startSetTimeoutAnimation8();
    
};
function startSetTimeoutAnimation() {
  var refreshRate = 1000 / 60;
  var maxXPosition = 900;
  var rect = document.getElementById('bubble1');
  var speedX = 1;
  var positionX = 0;

  window.setInterval(function () {
    positionX = positionX + speedX;
    if (positionX > maxXPosition || positionX < 0) {
      speedX = speedX * -1;
    }
    rect.style.bottom = positionX + 'px';
  }, refreshRate);
}

function startSetTimeoutAnimation2() {
  var refreshRate = 1000 / 60;
  var maxXPosition = 900;
  var rect = document.getElementById('bubble2');
  var speedX = 2;
  var positionX = 0;

  window.setInterval(function () {
    positionX = positionX + speedX;
    if (positionX > maxXPosition || positionX < 0) {
      speedX = speedX * -1;
    }
    rect.style.bottom = positionX + 'px';
  }, refreshRate);
}

function startSetTimeoutAnimation3() {
  var refreshRate = 1000 / 60;
  var maxXPosition = 900;
  var rect = document.getElementById('bubble3');
  var speedX = 5;
  var positionX = 0;

  window.setInterval(function () {
    positionX = positionX + speedX;
    if (positionX > maxXPosition || positionX < 0) {
      speedX = speedX * -1;
    }
    rect.style.bottom = positionX + 'px';
  }, refreshRate);
}

function startSetTimeoutAnimation4() {
  var refreshRate = 1000 / 60;
  var maxXPosition = 900;
  var rect = document.getElementById('bubble4');
  var speedX = 1;
  var positionX = 0;

  window.setInterval(function () {
    positionX = positionX + speedX;
    if (positionX > maxXPosition || positionX < 0) {
      speedX = speedX * -1;
    }
    rect.style.bottom = positionX + 'px';
  }, refreshRate);
}

function startSetTimeoutAnimation5() {
  var refreshRate = 1000 / 60;
  var maxXPosition = 900;
  var rect = document.getElementById('bubble5');
  var speedX = 2;
  var positionX = 0;

  window.setInterval(function () {
    positionX = positionX + speedX;
    if (positionX > maxXPosition || positionX < 0) {
      speedX = speedX * -1;
    }
    rect.style.bottom = positionX + 'px';
  }, refreshRate);
}

function startSetTimeoutAnimation6() {
  var refreshRate = 1000 / 60;
  var maxXPosition = 900;
  var rect = document.getElementById('bubble6');
  var speedX = 100;
  var positionX = 0;

  window.setInterval(function () {
    positionX = positionX + speedX;
    if (positionX > maxXPosition || positionX < 0) {
      speedX = speedX * -1;
    }
    rect.style.bottom = positionX + 'px';
  }, refreshRate);
}

function startSetTimeoutAnimation7() {
  var refreshRate = 1000 / 60;
  var maxXPosition = 900;
  var rect = document.getElementById('bubble7');
  var speedX = 3;
  var positionX = 0;

  window.setInterval(function () {
    positionX = positionX + speedX;
    if (positionX > maxXPosition || positionX < 0) {
      speedX = speedX * -1;
    }
    rect.style.bottom = positionX + 'px';
  }, refreshRate);
}

function startSetTimeoutAnimation8() {
  var refreshRate = 1000 / 60;
  var maxXPosition = 900;
  var rect = document.getElementById('bubble8');
  var speedX = 2;
  var positionX = 0;

  window.setInterval(function () {
    positionX = positionX + speedX;
    if (positionX > maxXPosition || positionX < 0) {
      speedX = speedX * -1;
    }
    rect.style.bottom = positionX + 'px';
  }, refreshRate);
}

/* function startAnimFrameAnimation() {
    var refreshRate = 1000 / 60;
    var maxXPosition = 400;
    var rect = document.getElementById('rect1');
    var speedX = 1;
    var positionX = 0;

function step() {
    positionX = positionX + speedX;
    if (positionX > maxXPosition || positionX < 0) {
        speedX = speedX * -1;
    }
    rect.style.left = positionX + 'px';
    window.requestAnimationFrame(step);
  }
    window.requestAnimationFrame(step);
}
*/