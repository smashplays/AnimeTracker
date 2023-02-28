import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CalendarComponent } from './pages/calendar/calendar.component';
import { ProfileComponent } from './pages/profile/profile.component';
import { PasswordComponent } from './pages/password/password.component';
import { ConfigComponent } from './pages/config/config.component';
import { SharedModule } from '../shared/shared.module';
import { UserRoutingModule } from './user-routing.module';
import { RouterModule } from '@angular/router';
import { MainComponent } from './pages/main/main.component';
import { FullCalendarModule } from '@fullcalendar/angular';



@NgModule({
  declarations: [
    CalendarComponent,
    ProfileComponent,
    PasswordComponent,
    ConfigComponent,
    MainComponent
  ],
  exports: [
    CalendarComponent,
    ProfileComponent,
    PasswordComponent,
    ConfigComponent
  ],
  imports: [
    CommonModule,
    SharedModule,
    RouterModule,
    FullCalendarModule,
    UserRoutingModule
  ]
})
export class UserModule { }
