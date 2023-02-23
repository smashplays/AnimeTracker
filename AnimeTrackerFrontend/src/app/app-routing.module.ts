import { NgModule } from '@angular/core';
import { RouterModule, Routes, CanActivate } from '@angular/router';
import { AuthGuard } from './auth.guard';
import { LoginComponent } from './auth/pages/login/login.component';
// import { AuthGuard } from './auth.guard';

const routes: Routes = [
  {
    path: 'auth',
    loadChildren: () => import('./auth/auth-routing.module').then(m => m.AuthRoutingModule)
  },
  {
    path: 'admin',
    loadChildren: () => import('./admin/admin-routing.module').then(m => m.AdminRoutingModule),
    // canActivate: [ AuthGuard]
    canActivateChild:[ AuthGuard]
  },
  {
    path: 'user',
    loadChildren: () => import('./user/user-routing.module').then(m => m.UserRoutingModule),
    //canActivate: [ AuthGuard]
    canActivateChild:[ AuthGuard]
  },
  {
    path: 'anime',
    loadChildren: () => import('./anime/anime-routing.module').then(m => m.AnimeRoutingModule),
    // canActivate: [ AuthGuard]
    canActivateChild:[ AuthGuard]
  },
  {
    path: '**',
    redirectTo: 'auth/login',
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
