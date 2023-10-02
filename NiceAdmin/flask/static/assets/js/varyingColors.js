// Define the initial colors
let color1 = 'rgba(255, 99, 132, 0.2)';
let color2 = 'rgba(54, 162, 235, 0.2)';

// Generate a random color between two colors
function generateRandomColor(color1, color2) {
  // Convert the colors to RGB format
  let rgbColor1 = color1.replace(/rgba?\(|\)/g, '').split(',').map(Number);
  let rgbColor2 = color2.replace(/rgba?\(|\)/g, '').split(',').map(Number);
  
  // Generate random RGB values within the range
  let r = Math.floor(Math.random() * (rgbColor2[0] - rgbColor1[0] + 1) + rgbColor1[0]);
  let g = Math.floor(Math.random() * (rgbColor2[1] - rgbColor1[1] + 1) + rgbColor1[1]);
  let b = Math.floor(Math.random() * (rgbColor2[2] - rgbColor1[2] + 1) + rgbColor1[2]);

  // Generate a random alpha value within the range
  let alpha = Math.random() * (parseFloat(color2.slice(-4, -1)) - parseFloat(color1.slice(-4, -1))) + parseFloat(color1.slice(-4, -1));
  
  // Construct the new color string
  let newColor = `rgba(${r}, ${g}, ${b}, ${alpha})`;
  
  return newColor;
}


