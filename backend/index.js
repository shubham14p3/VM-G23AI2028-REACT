// const express = require('express');
const mysql = require('mysql');
const cors = require('cors');
const bcrypt = require('bcryptjs');

const app = express();
app.use(cors());
app.use(express.json());

const db = mysql.createConnection({
  host: '192.168.10.12',
  user: 'your_username',
  password: 'your_password',
  database: 'userdb'
});

db.connect((err) => {
  if (err) {
    console.error('error connecting:', err);
    return;
  }
  console.log('Connected to MySQL');
});

app.post('/signup', async (req, res) => {
  const { username, password } = req.body;
  const hashedPassword = await bcrypt.hash(password, 10);
  const query = `INSERT INTO users (username, password) VALUES (?, ?)`;
  db.query(query, [username, hashedPassword], (err, results) => {
    if (err) {
      console.error(err);
      res.status(500).send('Error signing up');
    } else {
      res.send('User signed up successfully');
    }
  });
});

app.post('/login', async (req, res) => {
  const { username, password } = req.body;
  const query = `SELECT * FROM users WHERE username = ?`;
  db.query(query, [username], (err, results) => {
    if (err) {
      console.error(err);
      res.status(500).send('Error logging in');
    } else if (results.length === 0) {
      res.status(400).send('Invalid credentials');
    } else {
      const user = results[0];
      const hashedPassword = user.password;
      if (await bcrypt.compare(password, hashedPassword)) {
        res.send('Login successful');
      } else {
        res.status(400).send('Invalid credentials');
      }
    }
  });
});

app.get('/users', (req, res) => {
  const query = `SELECT * FROM users`;
  db.query(query, (err, results) => {
    if (err) {
      console.error(err);
      res.status(500).send('Error fetching users');
    } else {
      res.json(results);
    }
  });
});

app.listen(5000, () => {
  console.log('Server is running on port 5000');
});