import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/register/register.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { SharedModule } from '../shared/shared.module';
import { AuthRoutingModule } from './auth-routing.module';
import { MainComponent } from './pages/main/main.component';

@NgModule({
  declarations: [
    LoginComponent,
    RegisterComponent,
    MainComponent,
    
  ],
  exports:[
    LoginComponent,
    RegisterComponent
    
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    FormsModule,
    SharedModule,
    AuthRoutingModule
  ]
})
export class LoginModule { }
