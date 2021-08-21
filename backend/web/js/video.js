//Инструкция
//http://www.longtailvideo.com/support/jw-player/28832/about-jw-player.
//Один файл
// jwplayer("player").setup({
//     file:"/backend/web/video/pic.mp4",
//     image:"files/pic.jpg",
//     width:"640",
//     height:"480",
//     controls:true,
//     autostart:false,
//     mute:false,
//     stretching:"uniform",
//     title:"hello world",
// });
//Несколько
// jwplayer("player").setup({
//     width:"640",
//     height:"480",
//     listbar: {
//         position:'right',//right
//         size:150
//     },
//     playlist: [
//         {
//             file:"/backend/web/video/pic.mp4",
//             title:"hello world",
//             image:"files/pic.jpg",
//             description:"dsf sdjfhv sdjfhsdj fhsd vsdfj",
//         },
//
//         {
//             file:"/backend/web/video/pic.mp4",
//             title:"Second video",
//             image:"files/pic1.jpg"
//         },
//
//         {
//             file:"/backend/web/video/pic.mp4",
//             title:" next video",
//             image:"files/pic2.jpg"
//         },
//
//         {
//             file:"/backend/web/video/pic.mp4",
//             title:"Music",
//             image:"files/pic1.jpg"
//         }
//
//     ]
//
// });

//Несколько качеств
// jwplayer("player").setup({
//     width:"640",
//     height:"480",
//     listbar: {
//         position:'right',//right
//         size:150
//     },
//     playlist: [
//         {
//             title:"Sources",
//             image:"files/pic2.jpg",
//             description:"dsf sdjfhv sdjfhsdj fhsd vsdfj",
//             sources : [
//                 {
//                     file:"/backend/web/video/pic.mp4",
//                     label:"360p",
//                     title:"hello world",
//                     image:"files/pic.jpg",
//                 },
//                 {
//                     file:"/backend/web/video/pic.mp4",
//                     label:"780p",
//                     title:"second video",
//                     image:"files/pic2.jpg",
//                     default:true
//                 }
//             ]
//         }
//     ]
// });
//Добавление субтитров к видео
// jwplayer("player").setup({
//     file:"/backend/web/video/pic.mp4",
//     image:"/backend/web/video/pic.jpg",
//     tracks: [
//         {
//             file:"/backend/web/video/pic.vtt",
//             label:"English"
//         },
//         {
//             file:"/backend/web/video/pic.vtt",
//             label:"Russian",
//             default:true
//         }
//     ]
// });

//При наведение на время будет показываться рисунок
jwplayer("player").setup({
    file:"/backend/web/video/pic.mp4",
    image:"/backend/web/video/pic.jpg",
    tracks: [
        {
            file:"/backend/web/video/pic.vtt",
            kind: "thumbnails"
        }
    ]
});

function add_volume() {
    var volume = jwplayer('player').getVolume();

    if(volume < 100) {
        volume = volume + 10;
    }
    jwplayer('player').setVolume(volume);
}
