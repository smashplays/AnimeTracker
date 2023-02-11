import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AddAnimeFormComponent } from './pages/add-anime-form/add-anime-form.component';
import { AdminUsersComponent } from './pages/admin-users/admin-users.component';



@NgModule({
  declarations: [
    AddAnimeFormComponent,
    AdminUsersComponent
  ],
  exports: [
    AddAnimeFormComponent,
    AdminUsersComponent
  ],
  imports: [
    CommonModule
  ]
})
export class AdminModule { }
