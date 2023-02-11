import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/register/register.component';



@NgModule({
  declarations: [
    LoginComponent,
    RegisterComponent
  ],
  exports:[
    LoginComponent,
    RegisterComponent
  ],
  imports: [
    CommonModule
  ]
})
export class LoginModule { }
