/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GetMaxOnlineNumRes extends Rpc.Data
/*    */ {
/*    */   public int retcode;
/*    */   public int maxnum;
/*    */   public int fake_maxnum;
/*    */   public int curnum;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 21 */     os.marshal(this.retcode);
/* 22 */     os.marshal(this.maxnum);
/* 23 */     os.marshal(this.fake_maxnum);
/* 24 */     os.marshal(this.curnum);
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 30 */     this.retcode = os.unmarshal_int();
/* 31 */     this.maxnum = os.unmarshal_int();
/* 32 */     this.fake_maxnum = os.unmarshal_int();
/* 33 */     this.curnum = os.unmarshal_int();
/* 34 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 41 */       return (GetMaxOnlineNumRes)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 45 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GetMaxOnlineNumRes
 * JD-Core Version:    0.6.2
 */