import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AdminUsersComponent } from './pages/admin-users/admin-users.component';
import { SharedModule } from '../shared/shared.module';



@NgModule({
  declarations: [
    AdminUsersComponent
  ],
  exports: [
    AdminUsersComponent
  ],
  imports: [
    CommonModule,
    SharedModule
  ]
})
export class AdminModule { }
