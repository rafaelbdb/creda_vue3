CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT NOW(),
  updated_at TIMESTAMP DEFAULT NOW()
);

CREATE TABLE categories (
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  type VARCHAR(255) NOT NULL,
  user_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT NOW(),
  updated_at TIMESTAMP DEFAULT NOW(),
  FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

CREATE TABLE movements (
  id SERIAL PRIMARY KEY,
  date DATE NOT NULL,
  type VARCHAR(255) NOT NULL,
  category_id INT NOT NULL,
  description TEXT NOT NULL,
  amount NUMERIC(15, 2) NOT NULL,
  user_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT NOW(),
  updated_at TIMESTAMP DEFAULT NOW(),
  FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);


INSERT INTO users (name, email, password) 
VALUES ('John Doe', 'johndoe@example.com', 'password123');

INSERT INTO users (name, email, password) 
VALUES ('Jane Smith', 'janesmith@example.com', 'securepassword');

INSERT INTO users (name, email, password) 
VALUES ('Bob Johnson', 'bjohnson@example.com', '1234qwerty');

INSERT INTO categories (name, type, user_id)
VALUES ('Rent', 'Expense', 1);

INSERT INTO categories (name, type, user_id)
VALUES ('Salary', 'Income', 2);

INSERT INTO categories (name, type, user_id)
VALUES ('Groceries', 'Expense', 3);

INSERT INTO movements (date, type, category_id, description, amount, user_id)
VALUES ('2023-04-01', 'Expense', 1, 'Rent for April', 1000.00, 1);

INSERT INTO movements (date, type, category_id, description, amount, user_id)
VALUES ('2023-04-15', 'Income', 2, 'Salary for April', 2000.00, 2);

INSERT INTO movements (date, type, category_id, description, amount, user_id)
VALUES ('2023-04-10', 'Expense', 3, 'Groceries for the week', 150.00, 3);
