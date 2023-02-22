import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CharacterComponent } from './pages/character/character.component';
import { PopularListComponent } from './pages/popular-list/popular-list.component';
import { InfoComponent } from './pages/info/info.component';
import { AppRoutingModule } from '../app-routing.module';
import { SharedModule } from '../shared/shared.module';
import { MainComponent } from './pages/main/main.component';


@NgModule({
  declarations: [
    CharacterComponent,
    PopularListComponent,
    InfoComponent,
    MainComponent  
  ],
  exports: [
    CharacterComponent,
    PopularListComponent,
    InfoComponent
  ],
  imports: [
    CommonModule,
    AppRoutingModule,
    SharedModule
  ]
})
export class AnimeModule { }
