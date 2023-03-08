import { Component, OnInit } from '@angular/core';
import { LoginService } from '../../services/login.service';
import { Data } from '../../interfaces/login';
import { catchError, EMPTY, Observable } from 'rxjs';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
})
export class LoginComponent implements OnInit {
  name?: string;
  password?: string;
  logged: Observable<boolean> | boolean;
  mensaje: string;
  error: boolean = false;

  constructor(private router: Router, private loginservice: LoginService) {}

  ngOnInit(): void {
    this.loginservice.auth().subscribe((res) => {
      if (res) {
        console.log('Ya estas logeado');
        this.router.navigate(['user/calendar']);
      } else {
        console.log('no logged');
      }
    });
  }

  login(): void {
    const data: Data = {
      name: this.name,
      password: this.password,
    };

    if (!localStorage.getItem('token')) {
      this.loginservice
        .login(data)
        .pipe(
          catchError((err) => {
            if (err.status === 404) {
              console.log(err);
              this.error = !err.error.success;
              this.mensaje = err.error.message;
            }

            return EMPTY;
          })
        )
        .subscribe((res) => {
          if (res.success) {
            localStorage.setItem('token', res.data);
            console.log(res.data);
            this.router.navigate(['anime/popular']);
          }
        });
    } else {
      console.log('Ya estas logged');
    }
  }

  register(): void {
    this.router.navigate(['auth/register']);
  }

  logout(): void {
    if (localStorage.getItem('token')) {
      this.loginservice.logout().subscribe((res) => {
        if (res.success) {
          localStorage.removeItem('token');
          this.router.navigate(['login']);
        }
      });
    } else {
      console.log('No estas logeado');
    }
  }
}
