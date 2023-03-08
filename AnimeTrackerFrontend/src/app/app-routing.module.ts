import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './auth.guard';

const routes: Routes = [
  {
    path: 'auth',
    loadChildren: () =>
      import('./auth/auth-routing.module').then((m) => m.AuthRoutingModule),
  },
  {
    path: 'user',
    loadChildren: () =>
      import('./user/user-routing.module').then((m) => m.UserRoutingModule),
    canActivateChild: [AuthGuard],
  },
  {
    path: 'anime',
    loadChildren: () =>
      import('./anime/anime-routing.module').then((m) => m.AnimeRoutingModule),
    canActivateChild: [AuthGuard],
  },
  {
    path: '**',
    redirectTo: 'auth/login',
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
