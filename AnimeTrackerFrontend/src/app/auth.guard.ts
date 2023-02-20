import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, CanLoad, Route, RouterStateSnapshot, UrlSegment, UrlTree, Routes, Router } from '@angular/router';
import { Observable, tap } from 'rxjs';
import { LoginService } from './login/services/login.service';
import { Respuesta } from './login/interfaces/login';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {
  constructor(

    private router: Router,
    private loginservice: LoginService
  ) { }


  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): Observable<boolean> | Promise<boolean> | boolean {

    return this.loginservice.auth().pipe(tap( res => {
      if (!res) {
        this.router.navigate(['login']);
      }
      
    }));

  }
}
