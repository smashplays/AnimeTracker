import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AnimeSearchComponent } from './anime-search/anime-search.component';
import { FormsModule } from '@angular/forms';



@NgModule({
  declarations: [
    AnimeSearchComponent
  ],
  exports: [
    AnimeSearchComponent
  ],
  imports: [
    CommonModule,
    FormsModule
  ]
})
export class SharedModule { }
