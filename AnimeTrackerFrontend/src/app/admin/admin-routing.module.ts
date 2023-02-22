import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { AdminUsersComponent } from './pages/admin-users/admin-users.component';
import { MainComponent } from './pages/main/main.component';

const routes: Routes = [
  {
      path: '',
      component: MainComponent,
      children: [
        {
          path: 'admin-users',
          component: AdminUsersComponent
        },
        {
          path: '**',
          redirectTo: 'admin-users'
        }
      ]
  }
]

@NgModule({
  imports: [
    RouterModule.forChild(routes)
  ],
  exports: [
    RouterModule
  ]
})
export class AdminRoutingModule { }
