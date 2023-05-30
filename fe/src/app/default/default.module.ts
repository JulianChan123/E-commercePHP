import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { DefaultRoutingModule } from './default-routing.module';
import { DefaultComponent } from './default/default.component';
import { DtopbarComponent } from './dtopbar/dtopbar.component';
import { LoginComponent } from './login/login.component';
import { RegistroComponent } from './registro/registro.component';

@NgModule({
  declarations: [
    DefaultComponent,
    DtopbarComponent,
    LoginComponent,
    RegistroComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    DefaultRoutingModule
  ]
})
export class DefaultModule { }
