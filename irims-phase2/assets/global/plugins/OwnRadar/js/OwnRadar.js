var elementDimension = 50;
var elementRadius = elementDimension / 2;

var svgDimension = 100;

document.addEventListener("DOMContentLoaded", function() {
  
  // Get items.
  var items = document.getElementsByClassName("point");

  // Convert to array and set coordinates.
  [].slice.call(items).map(initDot);
  
});


/**
 * Init dot.
 *
 * @param {DOMElement} element Dot element.
 */
function initDot(element) {

  var midPoint = elementDimension / 2;

  var radius = element.dataset.r;
  var angle = element.dataset.a;
  var coords = getCoordinates(radius, angle);

  element.style.left = (midPoint + elementRadius * coords.x) + "vh";
  element.style.top = (midPoint + elementRadius * coords.y) + "vh";

  element.addEventListener("mouseover", mouseOverDot);
  element.addEventListener("mouseout", mouseOutDot);
  
}

/**
 * Hover.
 *
 * @param {event} event Event.
 */
function mouseOverDot(event) {
  
  // By default the description is on the bottom.
  var descriptionClass = 'description-container description-container--bottom';

  // If mouse pointer is on lower half of the screen,
  // move description to the top.
  if (event.clientY > window.innerHeight / 2) {
    descriptionClass = 'description-container description-container--top';      
  }

  // Prepare description values.
  var descriptionTitle = event.target.innerHTML;
  var descriptionContent = event.target.dataset.description;

  // Set content.
  document.getElementById('description-title').innerHTML = descriptionTitle;
  document.getElementById('description-content').innerHTML = descriptionContent;
  
  // Show description and set class.
  var descriptionElement = document.getElementById('description');
  descriptionElement.style.display = "block";
  descriptionElement.className = descriptionClass;

  var arrow = document.getElementById('arrow');
  arrow.setAttribute('visibility', 'visible');
  
  var radius = event.target.dataset.r;
  var angle = event.target.dataset.a;
  var velocity = -event.target.dataset.velocity || 5;

  // Starting point.
  var coords = getCoordinates(radius, angle);
  var x = svgDimension + svgDimension * coords.x;
  var y = svgDimension + svgDimension * coords.y;
  arrow.setAttribute('x1', x);
  arrow.setAttribute('y1', y);
  
  // Ending point.
  var coords2 = getCoordinates(velocity, angle);
  arrow.setAttribute('x2', x + coords2.x);
  arrow.setAttribute('y2', y + coords2.y);
  
}


/**
 * Hover.
 *
 * @param {event} event Event.
 */
function mouseOutDot(event) {

  document.getElementById("description").style.display = "none";

}


/**
 * Convert polar coordinate to regular coordinate.
 * 
 * @param {number} radius Radius.
 * @param {number} angle Angle.
 * @return {object} X and y coordinates: {x:0,y:0}
 */
function getCoordinates(radius, angle) {


  return {
    x: radius * Math.cos(angle/180*Math.PI),
    y: radius * Math.sin(angle/180*Math.PI)
  };
  
}