
import { Component } from '@angular/core';
import { User } from 'src/app/models/user/user';
import { RegistroService } from 'src/app/services/registro/registro.service';

@Component({
  selector: 'app-registro',
  templateUrl: './registro.component.html',
  styleUrls: ['./registro.component.css']
})
export class RegistroComponent {

  username!: string;
  password!: string;
  email!: string;
  name!: string;
  lastname!: string;


  constructor( private registroService: RegistroService ) { 
  }
  
  registro() {
    const userData:User = {
      username: this.username,
      password: this.password,
      email: this.email,
      name: this.name,
      lastname: this.lastname,
      id: 0
    };

    this.registroService.registrarUser(userData).subscribe(
        response => {
          console.log('Registro exitoso');
          
        },
        error => {
          console.error('Error en el registro', error);
        }
      );
  }

    
      



    

  
}
