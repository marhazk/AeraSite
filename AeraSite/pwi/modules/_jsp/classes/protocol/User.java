/*     */ package protocol;
/*     */ 
/*     */ import com.goldhuman.Common.Marshal.MarshalException;
/*     */ import com.goldhuman.Common.Marshal.OctetsStream;
/*     */ import com.goldhuman.Common.Octets;
/*     */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*     */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*     */ 
/*     */ public final class User extends Rpc.Data
/*     */ {
/*     */   public int logicuid;
/*     */   public int rolelist;
/*     */   public int cash;
/*     */   public int money;
/*     */   public int cash_add;
/*     */   public int cash_buy;
/*     */   public int cash_sell;
/*     */   public int cash_used;
/*     */   public int add_serial;
/*     */   public int use_serial;
/*     */   public Rpc.Data.DataVector exg_log;
/*     */   public Octets addiction;
/*     */   public Octets cash_password;
/*     */   public Rpc.Data.DataVector autolock;
/*     */   public byte status;
/*     */   public Rpc.Data.DataVector forbid;
/*     */   public Octets reference;
/*     */   public Octets consume_reward;
/*     */   public Octets taskcounter;
/*     */   public Octets cash_sysauction;
/*     */   public Octets login_record;
/*     */   public byte reserved31;
/*     */   public short reserved32;
/*     */ 
/*     */   public User()
/*     */   {
/*  36 */     this.exg_log = new Rpc.Data.DataVector(new StockLog());
/*  37 */     this.addiction = new Octets();
/*  38 */     this.cash_password = new Octets();
/*  39 */     this.autolock = new Rpc.Data.DataVector(new GPair());
/*  40 */     this.forbid = new Rpc.Data.DataVector(new GRoleForbid());
/*  41 */     this.reference = new Octets();
/*  42 */     this.consume_reward = new Octets();
/*  43 */     this.taskcounter = new Octets();
/*  44 */     this.cash_sysauction = new Octets();
/*  45 */     this.login_record = new Octets();
/*     */   }
/*     */ 
/*     */   public OctetsStream marshal(OctetsStream os)
/*     */   {
/*  50 */     os.marshal(this.logicuid);
/*  51 */     os.marshal(this.rolelist);
/*  52 */     os.marshal(this.cash);
/*  53 */     os.marshal(this.money);
/*  54 */     os.marshal(this.cash_add);
/*  55 */     os.marshal(this.cash_buy);
/*  56 */     os.marshal(this.cash_sell);
/*  57 */     os.marshal(this.cash_used);
/*  58 */     os.marshal(this.add_serial);
/*  59 */     os.marshal(this.use_serial);
/*  60 */     os.marshal(this.exg_log);
/*  61 */     os.marshal(this.addiction);
/*  62 */     os.marshal(this.cash_password);
/*  63 */     os.marshal(this.autolock);
/*  64 */     os.marshal(this.status);
/*  65 */     os.marshal(this.forbid);
/*  66 */     os.marshal(this.reference);
/*  67 */     os.marshal(this.consume_reward);
/*  68 */     os.marshal(this.taskcounter);
/*  69 */     os.marshal(this.cash_sysauction);
/*  70 */     os.marshal(this.login_record);
/*  71 */     os.marshal(this.reserved31);
/*  72 */     os.marshal(this.reserved32);
/*  73 */     return os;
/*     */   }
/*     */ 
/*     */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*     */   {
/*  78 */     this.logicuid = os.unmarshal_int();
/*  79 */     this.rolelist = os.unmarshal_int();
/*  80 */     this.cash = os.unmarshal_int();
/*  81 */     this.money = os.unmarshal_int();
/*  82 */     this.cash_add = os.unmarshal_int();
/*  83 */     this.cash_buy = os.unmarshal_int();
/*  84 */     this.cash_sell = os.unmarshal_int();
/*  85 */     this.cash_used = os.unmarshal_int();
/*  86 */     this.add_serial = os.unmarshal_int();
/*  87 */     this.use_serial = os.unmarshal_int();
/*  88 */     os.unmarshal(this.exg_log);
/*  89 */     os.unmarshal(this.addiction);
/*  90 */     os.unmarshal(this.cash_password);
/*  91 */     os.unmarshal(this.autolock);
/*  92 */     this.status = os.unmarshal_byte();
/*  93 */     os.unmarshal(this.forbid);
/*  94 */     os.unmarshal(this.reference);
/*  95 */     os.unmarshal(this.consume_reward);
/*  96 */     os.unmarshal(this.taskcounter);
/*  97 */     os.unmarshal(this.cash_sysauction);
/*  98 */     os.unmarshal(this.login_record);
/*  99 */     this.reserved31 = os.unmarshal_byte();
/* 100 */     this.reserved32 = os.unmarshal_short();
/* 101 */     return os;
/*     */   }
/*     */ 
/*     */   public Object clone()
/*     */   {
/*     */     try
/*     */     {
/* 108 */       User o = (User)super.clone();
/* 109 */       o.exg_log = ((Rpc.Data.DataVector)this.exg_log.clone());
/* 110 */       o.addiction = ((Octets)this.addiction.clone());
/* 111 */       o.cash_password = ((Octets)this.cash_password.clone());
/* 112 */       o.autolock = ((Rpc.Data.DataVector)this.autolock.clone());
/* 113 */       o.forbid = ((Rpc.Data.DataVector)this.forbid.clone());
/* 114 */       o.reference = ((Octets)this.reference.clone());
/* 115 */       o.consume_reward = ((Octets)this.consume_reward.clone());
/* 116 */       o.taskcounter = ((Octets)this.taskcounter.clone());
/* 117 */       o.cash_sysauction = ((Octets)this.cash_sysauction.clone());
/* 118 */       o.login_record = ((Octets)this.login_record.clone());
/* 119 */       return o;
/*     */     } catch (Exception e) {
/*     */     }
/* 122 */     return null;
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.User
 * JD-Core Version:    0.6.2
 */