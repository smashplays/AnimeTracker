import { Component, OnChanges, OnInit, SimpleChanges } from '@angular/core';
import { LoginService } from '../../services/login.service';
import { Data } from '../../interfaces/login';
import { Observable } from 'rxjs';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {


  name?: string;
  password?: string;
  logged: Observable<boolean> | boolean;






  constructor(
    private router: Router,
    private loginservice: LoginService
  ) { }

  ngOnInit(): void {



    if (this.loginservice.auth()) {

      this.router.navigate(['popular'])
    }
  }





  login():void {

    const data: Data = {
      name: this.name,
      password: this.password
    }

    if (!localStorage.getItem('token')) {
      this.loginservice.login(data).subscribe(res => {
        if (res.success) {
          localStorage.setItem("token", res.data);
          // console.log(res.success)
          this.router.navigate(['popular']);

        }

      });
    }

    else {
      console.log('Ya estas logged')
    }

  }

  logout():void {

    if (localStorage.getItem('token')) {
      this.loginservice.logout().subscribe(res => {
        if (res.success) {
          localStorage.removeItem('token');
          this.router.navigate(['login']);
        }
      });
    }

    else {
      console.log('No estas logeado')
    }

  }
}
