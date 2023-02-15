import { Component } from '@angular/core';
import { LoginService } from '../../services/login.service';
import { Data } from '../../interfaces/login';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {


  name?:string;
  password?:string;


  

  constructor(
    private loginservice : LoginService
  ){}


  login()
  {
    
const data:Data={
  name: this.name,
  password:this.password
}
    this.loginservice.login(data).subscribe(res => console.log(data));
  }

}
