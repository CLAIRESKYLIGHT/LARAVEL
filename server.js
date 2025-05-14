const { spawn } = require('child_process');
const path = require('path');

// Start PHP server
const php = spawn('php', ['artisan', 'serve', '--host=0.0.0.0', '--port=' + process.env.PORT]);

php.stdout.on('data', (data) => {
  console.log(`PHP Server: ${data}`);
});

php.stderr.on('data', (data) => {
  console.error(`PHP Server Error: ${data}`);
});

php.on('close', (code) => {
  console.log(`PHP Server process exited with code ${code}`);
}); 