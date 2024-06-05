import 'package:flutter/material.dart';
import 'package:attendex/firebase_options.dart';

Future<void> main() async {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: LoginPage(),
      theme: ThemeData(
        primaryColor: Colors.blue,
        fontFamily: 'Roboto',
      ),
    );
  }
}

class LoginPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          "Login",
          textAlign: TextAlign.center,
        ),
      ),
      body: Center(
        child: Padding(
          padding: EdgeInsets.all(20.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              TextFormField(
                decoration: InputDecoration(
                  labelText: 'Enrollment',
                  prefixIcon: Icon(Icons.person),
                  border: OutlineInputBorder(),
                ),
              ),
              SizedBox(height: 20.0),
              TextFormField(
                obscureText: true,
                decoration: InputDecoration(
                  labelText: 'Password',
                  prefixIcon: Icon(Icons.lock),
                  border: OutlineInputBorder(),
                ),
              ),
              SizedBox(height: 20.0),
              ElevatedButton(
                onPressed: () {
                  // Implement login logic here
                },
                child: Text('Login'),
                style: ElevatedButton.styleFrom(
                  padding: EdgeInsets.symmetric(vertical: 16),
                ),
              ),
              SizedBox(height: 20.0),
              TextButton(
                onPressed: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => RegisterPage()),
                  );
                },
                child: Text(
                  'Don\'t have an account? Register',
                  style: TextStyle(color: Colors.blue),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class RegisterPage extends StatelessWidget {
  final TextEditingController enrollmentController = TextEditingController();
  final TextEditingController emailController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();
  final TextEditingController confirmPasswordController =
  TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          "Register",
          textAlign: TextAlign.center,
        ),
      ),
      body: Center(
        child: Padding(
          padding: EdgeInsets.all(20.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              TextFormField(
                controller: enrollmentController,
                decoration: InputDecoration(
                  labelText: 'Enrollment',
                  prefixIcon: Icon(Icons.person),
                  border: OutlineInputBorder(),
                ),
              ),
              SizedBox(height: 20.0),
              TextFormField(
                controller: emailController,
                decoration: InputDecoration(
                  labelText: 'Email',
                  prefixIcon: Icon(Icons.email),
                  border: OutlineInputBorder(),
                ),
              ),
              SizedBox(height: 20.0),
              TextFormField(
                controller: passwordController,
                obscureText: true,
                decoration: InputDecoration(
                  labelText: 'Password',
                  prefixIcon: Icon(Icons.lock),
                  border: OutlineInputBorder(),
                ),
              ),
              SizedBox(height: 20.0),
              TextFormField(
                controller: confirmPasswordController,
                obscureText: true,
                decoration: InputDecoration(
                  labelText: 'Confirm Password',
                  prefixIcon: Icon(Icons.lock),
                  border: OutlineInputBorder(),
                ),
              ),
              SizedBox(height: 20.0),
              ElevatedButton(
                onPressed: () async {
                  // Validate registration data
                  if (passwordController.text != confirmPasswordController.text) {
                    // Passwords don't match, show error
                    ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                      content: Text('Passwords do not match!'),
                    ));
                    return;
                  }

                  // Add registration data to Firestore
                  // try {
                  //   FirebaseFirestore.instance.collection('users').add({
                  //     'enrollment': enrollmentController.text,
                  //     'email': emailController.text,
                  //     // You can add more fields here as needed
                  //   });
                  // } catch (e) {
                  //   print('Error adding user: $e');
                  //   // Handle error, show error message to user, etc.
                  // }

                  // Optionally, you can navigate back to the login page
                  Navigator.pop(context);
                },
                child: Text('Register'),
                style: ElevatedButton.styleFrom(
                  padding: EdgeInsets.symmetric(vertical: 16),
                ),
              ),
              SizedBox(height: 20.0),
              TextButton(
                onPressed: () {
                  // Navigate to login page
                  Navigator.pop(context);
                },
                child: Text(
                  'Already have an account? Login',
                  style: TextStyle(color: Colors.blue),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

