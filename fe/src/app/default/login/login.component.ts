import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  username: string | undefined;
  password: string | undefined;


  constructor(private http: HttpClient) {}

  login() {
    const userData = {
      username: this.username,
      password: this.password
    };

    this.http.post('http://127.0.0.1:8000/api/login', userData).subscribe(
        response => {
          console.log('Inicio de sesión exitoso');
          window.location.href = 'http://localhost:4200/admin/product'; //deberia ir a http://localhost:4200/default para ir al panel de usuario normal
        },
        error => {
          console.error('Error en el inicio de sesión', error);
        }
      );
  }
}
