/*     */ package protocol;
/*     */ 
/*     */ import com.goldhuman.Common.Marshal.OctetsStream;
/*     */ import com.goldhuman.Common.Octets;
/*     */ import com.goldhuman.IO.PollIO;
/*     */ import com.goldhuman.IO.Protocol.Protocol;
/*     */ import com.goldhuman.IO.Protocol.Rpc;
/*     */ import java.util.Collection;
/*     */ import java.util.Iterator;
/*     */ import java.util.Map;
/*     */ import java.util.Timer;
/*     */ import java.util.TimerTask;
/*     */ import java.util.TreeMap;
/*     */ import java.util.concurrent.atomic.AtomicInteger;
/*     */ 
/*     */ public class DeliveryDB
/*     */ {
/*  28 */   private static AtomicInteger tid_seed = new AtomicInteger(0);
/*     */ 
/*  34 */   private static Map map = new TreeMap();
/*     */ 
/*  70 */   private static DeliveryDB instance = new DeliveryDB();
/*     */ 
/*  72 */   public static final Object locker = new Object();
/*  73 */   public static DeliveryClientManager mgr = DeliveryClientManager.GetInstance();
/*     */ 
/*     */   private static Integer getTid_seed()
/*     */   {
/*  30 */     Integer tid = Integer.valueOf(tid_seed.incrementAndGet());
/*  31 */     if (tid.intValue() >= 1073741824) tid_seed.set(0);
/*  32 */     return Integer.valueOf(1);
/*     */   }
/*     */ 
/*     */   public static void init()
/*     */     throws Exception
/*     */   {
/*     */   }
/*     */ 
/*     */   public static boolean SysSendMail(int receiver, String title, String context, GRoleInventory attach_obj, int attach_money)
/*     */     throws Exception
/*     */   {
/*  90 */     init();
/*  91 */     if (null == mgr.s) {
/*  92 */       return false;
/*     */     }
/*  94 */     SysSendMail pc = (SysSendMail)Protocol.Create("SysSendMail");
/*  95 */     pc.tid = getTid_seed().intValue();
/*  96 */     pc.sysid = 32;
/*  97 */     pc.sys_type = 3;
/*  98 */     pc.receiver = receiver;
/*  99 */     pc.title.setString(title);
/* 100 */     pc.context.setString(context);
/* 101 */     pc.attach_obj = attach_obj;
/* 102 */     pc.attach_money = attach_money;
/*     */ 
/* 104 */     ProtocolWrapper pw = new ProtocolWrapper(35, pc);
/* 105 */     synchronized (map)
/*     */     {
/* 107 */       map.put(new Integer(pc.tid), pw);
/*     */     }
/*     */ 
/* 110 */     synchronized (pw)
/*     */     {
/* 112 */       if (!mgr.Send(mgr.s, pc))
/* 113 */         return false;
/* 114 */       PollIO.WakeUp();
/* 115 */       pw.wait();
/* 116 */       return 0 == pw.retcode;
/*     */     }
/*     */   }
/*     */ 
/*     */   public static void SysSendMail_Re(short retcode, int tid) {
/* 121 */     ProtocolWrapper pw = null;
/* 122 */     synchronized (map)
/*     */     {
/* 124 */       pw = (ProtocolWrapper)map.get(new Integer(tid));
/* 125 */       map.remove(new Integer(tid));
/*     */     }
/*     */ 
/* 128 */     synchronized (pw)
/*     */     {
/* 130 */       pw.retcode = retcode;
/* 131 */       pw.notify();
/*     */     }
/*     */   }
/*     */ 
/*     */   public static GMControlGame_Re GMControlGame(int worldtag, String command) throws Exception {
/* 136 */     init();
/* 137 */     if (null == mgr.s) {
/* 138 */       return null;
/*     */     }
/* 140 */     GMControlGame pc = (GMControlGame)Protocol.Create("GMControlGame");
/* 141 */     pc.xid = getTid_seed().intValue();
/* 142 */     pc.worldtag = worldtag;
/* 143 */     pc.command.replace(command.getBytes("GBK"));
/*     */ 
/* 145 */     ProtocolWrapper pw = new ProtocolWrapper(36, pc);
/* 146 */     synchronized (map)
/*     */     {
/* 148 */       map.put(new Integer(pc.xid), pw);
/*     */     }
/*     */ 
/* 151 */     synchronized (pw)
/*     */     {
/* 153 */       if (!mgr.Send(mgr.s, pc))
/* 154 */         return null;
/* 155 */       PollIO.WakeUp();
/* 156 */       pw.wait();
/* 157 */       return (GMControlGame_Re)pw.cookie;
/*     */     }
/*     */   }
/*     */ 
/*     */   public static void GMControlGame_Re(GMControlGame_Re re) {
/* 162 */     ProtocolWrapper pw = null;
/* 163 */     synchronized (map)
/*     */     {
/* 165 */       pw = (ProtocolWrapper)map.get(new Integer(re.xid));
/* 166 */       map.remove(new Integer(re.xid));
/*     */     }
/*     */ 
/* 169 */     synchronized (pw)
/*     */     {
/* 171 */       pw.retcode = re.retcode;
/* 172 */       pw.cookie = re;
/* 173 */       pw.notify();
/*     */     }
/*     */   }
/*     */ 
/*     */   public static int GMForbidRole(byte fbd_type, int gmroleid, int localsid, int dstroleid, int forbid_time, String reason) throws Exception
/*     */   {
/* 179 */     init();
/* 180 */     if (null == mgr.s) {
/* 181 */       return -1;
/*     */     }
/* 183 */     GMForbidRole pc = (GMForbidRole)Protocol.Create("GMForbidRole");
/* 184 */     pc.fbd_type = fbd_type;
/* 185 */     pc.gmroleid = gmroleid;
/* 186 */     pc.localsid = localsid;
/* 187 */     pc.dstroleid = dstroleid;
/* 188 */     pc.forbid_time = forbid_time;
/* 189 */     pc.reason.setString(reason);
/*     */ 
/* 199 */     if (!mgr.Send(mgr.s, pc))
/* 200 */       return -1;
/* 201 */     PollIO.WakeUp();
/* 202 */     return 0;
/*     */   }
/*     */ 
/*     */   public static void GMForbidRole_Re(int retcode, byte fbd_type, int dstroleid, int forbid_time)
/*     */   {
/* 209 */     ProtocolWrapper pw = null;
/* 210 */     synchronized (map)
/*     */     {
/* 212 */       pw = (ProtocolWrapper)map.get(new Integer(-dstroleid));
/* 213 */       map.remove(new Integer(-dstroleid));
/*     */     }
/*     */ 
/* 216 */     synchronized (pw)
/*     */     {
/* 218 */       pw.retcode = retcode;
/* 219 */       pw.notify();
/*     */     }
/*     */   }
/*     */ 
/*     */   public static boolean GMRestartServer(int gmroleid, int restart_time) throws Exception {
/* 224 */     init();
/* 225 */     if (null == mgr.s)
/* 226 */       return false;
/* 227 */     GMRestartServer restart = (GMRestartServer)Protocol.Create("GMRestartServer");
/* 228 */     restart.gmroleid = gmroleid;
/* 229 */     restart.restart_time = restart_time;
/* 230 */     boolean r = mgr.Send(mgr.s, restart);
/* 231 */     PollIO.WakeUp();
/* 232 */     return r;
/*     */   }
/*     */ 
/*     */   public static boolean GMPrivilegeChange(int userid) throws Exception {
/* 236 */     init();
/* 237 */     if (null == mgr.s)
/* 238 */       return false;
/* 239 */     GMPrivilegeChange gmpc = (GMPrivilegeChange)Protocol.Create("GMPrivilegeChange");
/* 240 */     gmpc.userid = userid;
/* 241 */     boolean r = mgr.Send(mgr.s, gmpc);
/* 242 */     PollIO.WakeUp();
/* 243 */     return r;
/*     */   }
/*     */ 
/*     */   public static int getRoleLogStatus(int roleid) throws Exception {
/* 247 */     init();
/* 248 */     if (null == mgr.s)
/* 249 */       return -1;
/* 250 */     RoleId arg = new RoleId();
/* 251 */     arg.id = roleid;
/*     */ 
/* 253 */     GMQueryRoleInfo rpc = (GMQueryRoleInfo)Rpc.Call("GMQueryRoleInfo", arg);
/* 254 */     if (!mgr.Send(mgr.s, rpc))
/* 255 */       return -1;
/* 256 */     PollIO.WakeUp();
/* 257 */     synchronized (rpc) { rpc.wait(); }
/* 258 */     return rpc.status;
/*     */   }
/*     */ 
/*     */   public static boolean broadcast(byte type, int roleid, String msg) throws Exception {
/* 262 */     init();
/* 263 */     if (null == mgr.s)
/* 264 */       return false;
/* 265 */     PublicChat pc = (PublicChat)Protocol.Create("PublicChat");
/* 266 */     pc.msg.setString(msg);
/* 267 */     pc.roleid = roleid;
/* 268 */     pc.channel = type;
/* 269 */     pc.emotion = 0;
/* 270 */     boolean r = mgr.Send(mgr.s, pc);
/* 271 */     PollIO.WakeUp();
/* 272 */     return r;
/*     */   }
/*     */ 
/*     */   public static boolean replyComplain(int roleid, int gmroleid, String gmrolename, String msg) throws Exception
/*     */   {
/* 277 */     init();
/* 278 */     if (null == mgr.s)
/* 279 */       return false;
/* 280 */     PrivateChat pc = (PrivateChat)Protocol.Create("PrivateChat");
/* 281 */     pc.msg.setString(msg);
/* 282 */     pc.channel = 5;
/* 283 */     pc.srcroleid = gmroleid;
/* 284 */     pc.src_name.setString(gmrolename);
/* 285 */     pc.dstroleid = roleid;
/* 286 */     boolean r = mgr.Send(mgr.s, pc);
/* 287 */     PollIO.WakeUp();
/* 288 */     return r;
/*     */   }
/*     */ 
/*     */   public static boolean SetMaxOnlineNum(int maxnum, int fakemaxnum) throws Exception {
/* 292 */     init();
/* 293 */     if (null == mgr.s)
/* 294 */       return false;
/* 295 */     SetMaxOnlineNum proto = (SetMaxOnlineNum)Protocol.Create("SetMaxOnlineNum");
/* 296 */     proto.maxnum = maxnum;
/* 297 */     proto.fake_maxnum = fakemaxnum;
/* 298 */     boolean r = mgr.Send(mgr.s, proto);
/* 299 */     PollIO.WakeUp();
/* 300 */     return r;
/*     */   }
/*     */ 
/*     */   public static boolean GetMaxOnlineNum(Integer[] curmax) throws Exception {
/* 304 */     init();
/* 305 */     if (null == mgr.s) {
/* 306 */       return false;
/*     */     }
/* 308 */     GetMaxOnlineNumArg arg = new GetMaxOnlineNumArg();
/* 309 */     arg.padding = 0;
/* 310 */     GetMaxOnlineNum rpc = (GetMaxOnlineNum)Rpc.Call("GetMaxOnlineNum", arg);
/* 311 */     if (!mgr.Send(mgr.s, rpc))
/* 312 */       return false;
/* 313 */     PollIO.WakeUp();
/* 314 */     synchronized (rpc) { rpc.wait(); }
/* 315 */     if (0 == rpc.retcode)
/*     */     {
/* 317 */       curmax[0] = new Integer(rpc.maxnum);
/* 318 */       curmax[1] = new Integer(rpc.fakemaxnum);
/* 319 */       curmax[2] = new Integer(rpc.curnum);
/*     */     }
/* 321 */     return 0 == rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static boolean GMGetGameAttri(int gmroleid, byte attribute, Octets[] values) throws Exception {
/* 325 */     init();
/* 326 */     if (null == mgr.s) {
/* 327 */       return false;
/*     */     }
/* 329 */     GMGetGameAttriArg arg = new GMGetGameAttriArg();
/* 330 */     arg.gmroleid = gmroleid;
/* 331 */     arg.localsid = -1;
/* 332 */     arg.attribute = attribute;
/* 333 */     GMGetGameAttri rpc = (GMGetGameAttri)Rpc.Call("GMGetGameAttri", arg);
/* 334 */     if (!mgr.Send(mgr.s, rpc))
/* 335 */       return false;
/* 336 */     PollIO.WakeUp();
/* 337 */     synchronized (rpc) { rpc.wait(); }
/* 338 */     values[0] = rpc.value;
/* 339 */     return (null != rpc.value) && (rpc.value.size() > 0);
/*     */   }
/*     */ 
/*     */   public static boolean GMSetGameAttri(int gmroleid, byte attribute, Octets value) throws Exception {
/* 343 */     init();
/* 344 */     if (null == mgr.s) {
/* 345 */       return false;
/*     */     }
/* 347 */     GMSetGameAttriArg arg = new GMSetGameAttriArg();
/* 348 */     arg.gmroleid = gmroleid;
/* 349 */     arg.localsid = -1;
/* 350 */     arg.attribute = attribute;
/* 351 */     arg.value = value;
/* 352 */     GMSetGameAttri rpc = (GMSetGameAttri)Rpc.Call("GMSetGameAttri", arg);
/* 353 */     if (!mgr.Send(mgr.s, rpc))
/* 354 */       return false;
/* 355 */     PollIO.WakeUp();
/* 356 */     synchronized (rpc) { rpc.wait(); }
/* 357 */     return 0 == rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static byte GMGetGameAttriByte(byte type) throws Exception {
/* 361 */     Octets[] values = new Octets[1];
/* 362 */     if ((GMGetGameAttri(-1, type, values)) && (null != values[0]) && (values[0].size() >= 1))
/*     */     {
/* 364 */       OctetsStream os = new OctetsStream(values[0]);
/* 365 */       byte status = os.unmarshal_byte();
/* 366 */       return status;
/*     */     }
/* 368 */     return -1;
/*     */   }
/*     */ 
/*     */   public static boolean GMSetGameAttriByte(byte type, byte value) throws Exception {
/* 372 */     OctetsStream os = new OctetsStream();
/* 373 */     os.marshal(value);
/* 374 */     return GMSetGameAttri(-1, type, os);
/*     */   }
/*     */ 
/*     */   public static byte GMGetDoubleExp() throws Exception {
/* 378 */     return GMGetGameAttriByte((byte)-52);
/*     */   }
/*     */ 
/*     */   public static boolean GMSetDoubleExp(int b) throws Exception
/*     */   {
/* 383 */     return GMSetGameAttriByte((byte)-52, (byte)b);
/*     */   }
/*     */ 
/*     */   public static int GMGetLambda() throws Exception {
/* 387 */     Octets[] values = new Octets[1];
/* 388 */     if ((GMGetGameAttri(-1, (byte)-51, values)) && (null != values[0]) && (values[0].size() >= 1))
/*     */     {
/* 390 */       OctetsStream os = new OctetsStream(values[0]);
/* 391 */       byte temp = os.unmarshal_byte();
/* 392 */       int lambda = 0xFF & temp;
/* 393 */       return lambda;
/*     */     }
/* 395 */     return -1;
/*     */   }
/*     */ 
/*     */   public static boolean GMSetLambda(int lambda) throws Exception {
/* 399 */     byte temp = (byte)lambda;
/* 400 */     return GMSetGameAttriByte((byte)-51, temp);
/*     */   }
/*     */ 
/*     */   public static byte GMGetNoTrade() throws Exception {
/* 404 */     return GMGetGameAttriByte((byte)-49);
/*     */   }
/*     */ 
/*     */   public static boolean GMSetNoTrade(boolean b) throws Exception {
/* 408 */     return GMSetGameAttriByte((byte)-49, (byte)(b ? 1 : 0));
/*     */   }
/*     */ 
/*     */   public static byte GMGetNoAuction() throws Exception {
/* 412 */     return GMGetGameAttriByte((byte)-48);
/*     */   }
/*     */ 
/*     */   public static boolean GMSetNoAuction(boolean b) throws Exception {
/* 416 */     return GMSetGameAttriByte((byte)-48, (byte)(b ? 1 : 0));
/*     */   }
/*     */ 
/*     */   public static byte GMGetNoMail() throws Exception {
/* 420 */     return GMGetGameAttriByte((byte)-47);
/*     */   }
/*     */ 
/*     */   public static boolean GMSetNoMail(boolean b) throws Exception {
/* 424 */     return GMSetGameAttriByte((byte)-47, (byte)(b ? 1 : 0));
/*     */   }
/*     */ 
/*     */   public static byte GMGetNoFaction() throws Exception {
/* 428 */     return GMGetGameAttriByte((byte)-46);
/*     */   }
/*     */ 
/*     */   public static boolean GMSetNoFaction(boolean b) throws Exception {
/* 432 */     return GMSetGameAttriByte((byte)-46, (byte)(b ? 1 : 0));
/*     */   }
/*     */ 
/*     */   public static byte GMGetDoubleMoney() throws Exception {
/* 436 */     return GMGetGameAttriByte((byte)-45);
/*     */   }
/*     */ 
/*     */   public static boolean GMSetDoubleMoney(boolean b) throws Exception {
/* 440 */     return GMSetGameAttriByte((byte)-45, (byte)(b ? 1 : 0));
/*     */   }
/*     */ 
/*     */   public static byte GMGetDoubleObject() throws Exception {
/* 444 */     return GMGetGameAttriByte((byte)-44);
/*     */   }
/*     */ 
/*     */   public static boolean GMSetDoubleObject(boolean b) throws Exception {
/* 448 */     return GMSetGameAttriByte((byte)-44, (byte)(b ? 1 : 0));
/*     */   }
/*     */ 
/*     */   public static byte GMGetDoubleSP() throws Exception {
/* 452 */     return GMGetGameAttriByte((byte)-43);
/*     */   }
/*     */ 
/*     */   public static boolean GMSetDoubleSP(boolean b) throws Exception {
/* 456 */     return GMSetGameAttriByte((byte)-43, (byte)(b ? 1 : 0));
/*     */   }
/*     */ 
/*     */   public static byte GMGetNoSellPoint() throws Exception {
/* 460 */     return GMGetGameAttriByte((byte)-42);
/*     */   }
/*     */ 
/*     */   public static boolean GMSetNoSellPoint(boolean b) throws Exception {
/* 464 */     return GMSetGameAttriByte((byte)-42, (byte)(b ? 1 : 0));
/*     */   }
/*     */ 
/*     */   public static boolean DisableAutolock(int userid) throws Exception
/*     */   {
/* 469 */     init();
/* 470 */     if (null == mgr.s) return false;
/* 471 */     DisableAutolock pc = (DisableAutolock)Protocol.Create("DisableAutolock");
/* 472 */     pc.userid = userid;
/* 473 */     if (!mgr.Send(mgr.s, pc)) return false;
/* 474 */     PollIO.WakeUp();
/* 475 */     return true;
/*     */   }
/*     */ 
/*     */   public static GRoleForbid DlyForbidUser(int operation, int userid, int time, String reason, int opId) throws Exception
/*     */   {
/* 480 */     init();
/* 481 */     if (null == mgr.s)
/* 482 */       return null;
/* 483 */     ForbidUserArg arg = new ForbidUserArg();
/* 484 */     arg.operation = ((byte)operation);
/* 485 */     arg.gmuserid = opId;
/* 486 */     arg.userid = userid;
/* 487 */     arg.time = time;
/* 488 */     arg.reason.setString(reason);
/*     */ 
/* 490 */     ForbidUser rpc = (ForbidUser)Rpc.Call("ForbidUser", arg);
/* 491 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络链接未建立.(ForbidUser");
/* 492 */     PollIO.WakeUp();
/* 493 */     synchronized (rpc) { rpc.wait(); }
/* 494 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时.(ForbidUser)");
/* 495 */     return 0 == rpc.retcode ? rpc.groleforbid : null;
/*     */   }
/*     */ 
/*     */   public static SysRecoveredObjMail_Re SysRecoveredObjMail(int receiver, String title, String context, String obj, String checksum) throws Exception
/*     */   {
/* 500 */     init();
/* 501 */     if (null == mgr.s) {
/* 502 */       return null;
/*     */     }
/* 504 */     SysRecoveredObjMail pc = (SysRecoveredObjMail)Protocol.Create("SysRecoveredObjMail");
/* 505 */     pc.tid = getTid_seed().intValue();
/*     */ 
/* 507 */     pc.sys_type = 3;
/* 508 */     pc.receiver = receiver;
/* 509 */     pc.title.setString(title);
/* 510 */     pc.context.setString(context);
/* 511 */     pc.obj.insert(0, obj.getBytes("iso-8859-1"));
/* 512 */     pc.checksum.insert(0, checksum.getBytes("iso-8859-1"));
/*     */ 
/* 514 */     ProtocolWrapper pw = new ProtocolWrapper(37, pc);
/* 515 */     synchronized (map)
/*     */     {
/* 517 */       map.put(new Integer(pc.tid), pw);
/*     */     }
/*     */ 
/* 520 */     synchronized (pw)
/*     */     {
/* 522 */       if (!mgr.Send(mgr.s, pc))
/* 523 */         return null;
/* 524 */       PollIO.WakeUp();
/* 525 */       pw.wait();
/* 526 */       return (SysRecoveredObjMail_Re)pw.cookie;
/*     */     }
/*     */   }
/*     */ 
/*     */   public static void SysRecoveredObjMail_Re(SysRecoveredObjMail_Re re) {
/* 531 */     ProtocolWrapper pw = null;
/* 532 */     synchronized (map)
/*     */     {
/* 534 */       pw = (ProtocolWrapper)map.get(new Integer(re.tid));
/* 535 */       map.remove(new Integer(re.tid));
/*     */     }
/*     */ 
/* 538 */     synchronized (pw)
/*     */     {
/* 540 */       pw.retcode = re.retcode;
/* 541 */       pw.cookie = re;
/* 542 */       pw.notify();
/*     */     }
/*     */   }
/*     */ 
/*     */   static
/*     */   {
/*  37 */     new Timer().schedule(new TimerTask() {
/*     */       public void run() {
/*     */         try {
/*  40 */           DeliveryDB.init(); } catch (Exception ex) { ex.printStackTrace(); }
/*     */ 
/*     */       }
/*     */     }
/*     */     , 30000L, 120000L);
/*     */ 
/*  44 */     new Timer().schedule(new TimerTask()
/*     */     {
/*     */       public void run()
/*     */       {
/*     */         try
/*     */         {
/*     */           Iterator it;
/*  49 */           synchronized (DeliveryDB.map)
/*     */           {
/*  51 */             for (it = DeliveryDB.map.values().iterator(); it.hasNext(); )
/*     */             {
/*  53 */               DeliveryDB.ProtocolWrapper pw = (DeliveryDB.ProtocolWrapper)it.next();
/*  54 */               pw.ttl -= 1;
/*  55 */               if (pw.ttl <= 0)
/*     */               {
/*  57 */                 it.remove();
/*  58 */                 synchronized (pw) { pw.notify(); } 
/*     */               }
/*     */             }
/*     */           }
/*     */         } catch (Exception ex) { ex.printStackTrace(); }
/*     */ 
/*     */       }
/*     */     }
/*     */     , 5000L, 1000L);
/*     */   }
/*     */ 
/*     */   public static class ProtocolWrapper
/*     */   {
/*     */     public int ttl;
/*     */     public Protocol protocol;
/*     */     public int retcode;
/*     */     public Object cookie;
/*     */ 
/*     */     public ProtocolWrapper(int ttl, Protocol protocol)
/*     */     {
/*  22 */       this.ttl = ttl;
/*  23 */       this.protocol = protocol;
/*  24 */       this.retcode = -1;
/*     */     }
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.DeliveryDB
 * JD-Core Version:    0.6.2
 */