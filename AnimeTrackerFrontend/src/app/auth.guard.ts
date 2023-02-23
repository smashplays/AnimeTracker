import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, CanLoad, Route, RouterStateSnapshot, UrlSegment, UrlTree, Routes, Router, CanActivateChild } from '@angular/router';
import { Observable, tap } from 'rxjs';
import { LoginService } from './auth/services/login.service';
import { Respuesta } from './auth/interfaces/login';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate,CanActivateChild{
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

  canActivateChild(
    childRoute: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
      return this.loginservice.auth().pipe(tap( res => {
        if (!res) {
          this.router.navigate(['auth/login']);
        }
        
      }));
  }
}
